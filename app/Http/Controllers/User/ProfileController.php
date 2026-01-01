<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Show profile page.
     */
    public function show()
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        // Get total actions
        $totalActions = $user->microActions()->count();
        $completedActions = $user->microActions()->completed()->count();
        
        return view('user.profile', compact('user', 'totalActions', 'completedActions'));
    }
    
    /**
     * Update profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        $user->update([
            'name' => $request->name,
        ]);
        
        return back()->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Upload avatar.
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        // Delete old avatar if exists
        if ($user->avatar) {
            $oldPath = public_path($user->avatar);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }
        
        // Create avatars directory if not exists
        $avatarDir = public_path('avatars');
        if (!File::exists($avatarDir)) {
            File::makeDirectory($avatarDir, 0755, true);
        }
        
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
        
        // Move file to public/avatars
        $request->file('avatar')->move($avatarDir, $filename);
        
        // Save path relatif ke database (tanpa 'public/')
        $path = 'avatars/' . $filename;
        
        $user->update(['avatar' => $path]);
        
        return back()->with('success', 'Avatar updated successfully!');
    }
    
    /**
     * Delete avatar.
     */
    public function deleteAvatar()
    {
        $user = user();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }
        
        if ($user->avatar) {
            $avatarPath = public_path($user->avatar);
            if (File::exists($avatarPath)) {
                File::delete($avatarPath);
            }
            $user->update(['avatar' => null]);
        }
        
        return back()->with('success', 'Avatar removed.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = User::where('role', 'user');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $users = $query->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle avatar upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avatars'), $filename);
            $avatarPath = 'avatars/' . $filename;
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'avatar' => $avatarPath,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }
    
    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        
        // Get user stats
        $totalActions = $user->microActions()->count();
        $completedActions = $user->microActions()->completed()->count();
        $completionRate = $totalActions > 0 
            ? round(($completedActions / $totalActions) * 100, 1) 
            : 0;
        
        // Get recent actions
        $recentActions = $user->microActions()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        return view('admin.users.show', compact(
            'user',
            'totalActions',
            'completedActions',
            'completionRate',
            'recentActions'
        ));
    }
    
    /**
     * Display user's activity log.
     */
    public function activityLog($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        
        $actions = $user->microActions()
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.users.activity', compact('user', 'actions'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user's profile information.
     */
    public function update(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('users')->ignore($user->id)
            ],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $avatar = $request->file('avatar');
            $filename = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avatars'), $filename);
            $validated['avatar'] = 'avatars/' . $filename;
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User profile updated successfully.');
    }

    /**
     * Update the specified user's password.
     */
    public function updatePassword(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'User password updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        
        // Delete avatar if exists
        if ($user->avatar && file_exists(public_path($user->avatar))) {
            unlink(public_path($user->avatar));
        }
        
        // Delete user's associated data
        $user->microActions()->delete();
        $user->growthLogs()->delete();
        
        // Delete user
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
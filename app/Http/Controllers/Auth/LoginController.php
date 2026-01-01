<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected AuthService $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Attempt authentication
        $user = $this->authService->attempt(
            $request->email,
            $request->password
        );
        
        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'These credentials do not match our records.',
                ]);
        }
        
        // Login user
        $this->authService->login($user, $request->boolean('remember'));
        
        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back, Admin!');
        }
        
        return redirect()->route('user.dashboard')
            ->with('success', 'Welcome back!');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;

class LogoutController extends Controller
{
    protected AuthService $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    /**
     * Handle logout request.
     */
    public function logout()
    {
        $this->authService->logout();
        
        return redirect()->route('login')
            ->with('success', 'You have been logged out.');
    }
}
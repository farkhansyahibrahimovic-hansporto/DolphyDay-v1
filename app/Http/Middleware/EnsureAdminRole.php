<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AuthService;

class EnsureAdminRole
{
    protected AuthService $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->authService->user();
        
        // Double check user exists
        if (!$user) {
            abort(401, 'Unauthenticated');
        }
        
        // Cek role - jika user biasa, redirect ke user dashboard
        if ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }
        
        // Jika bukan admin, abort
        if ($user->role !== 'admin') {
            abort(403, 'Admin access required.');
        }
        
        return $next($request);
    }
}
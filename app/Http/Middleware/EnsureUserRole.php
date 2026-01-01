<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AuthService;

class EnsureUserRole
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
        
        // Cek role - jika admin, redirect ke admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Jika bukan user, abort
        if ($user->role !== 'user') {
            abort(403, 'Unauthorized access.');
        }
        
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    protected AuthService $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('🛡️ GUEST MIDDLEWARE', [
            'url' => $request->fullUrl(),
            'path' => $request->path(),
            'method' => $request->method()
        ]);
        
        if ($this->authService->check()) {
            $user = $this->authService->user();
            
            Log::info('🔄 User authenticated - redirecting', [
                'user_id' => $user?->id,
                'role' => $user?->role
            ]);
            
            if (!$user) {
                Log::error('⚠️ check() TRUE but user() NULL - clearing session');
                session()->flush();
                return $next($request);
            }
            
            if ($user->role === 'admin') {
                Log::info('➡️ Redirecting to admin dashboard');
                return redirect()->route('admin.dashboard');
            }
            
            Log::info('➡️ Redirecting to user dashboard');
            return redirect()->route('user.dashboard');
        }
        
        Log::info('✅ Guest - continuing to page');
        return $next($request);
    }
}
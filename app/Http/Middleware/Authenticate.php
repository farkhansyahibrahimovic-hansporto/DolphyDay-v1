<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AuthService;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    protected AuthService $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('🔒 AUTH MIDDLEWARE', [
            'url' => $request->fullUrl(),
            'path' => $request->path(),
            'method' => $request->method()
        ]);
        
        if ($this->authService->guest()) {
            Log::info('❌ Guest detected - redirecting to login');
            
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            
            return redirect()->guest(route('login'));
        }
        
        Log::info('✅ Authenticated - continuing');
        return $next($request);
    }
}
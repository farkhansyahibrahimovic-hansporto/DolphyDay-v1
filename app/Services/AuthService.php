<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthService
{
    protected ?User $cachedUser = null;
    protected bool $userResolved = false;
    
    public function attempt(string $email, string $password): ?User
    {
        $user = User::where('email', $email)->first();
        
        if (!$user || !Hash::check($password, $user->password)) {
            Log::info('❌ Login failed', ['email' => $email]);
            return null;
        }
        
        Log::info('✅ Login successful', ['user_id' => $user->id, 'role' => $user->role]);
        return $user;
    }
    
    public function login(User $user, bool $remember = false): void
    {
        Log::info('🔐 LOGIN START', [
            'user_id' => $user->id,
            'role' => $user->role,
            'remember' => $remember
        ]);
        
        session()->put('user_id', $user->id);
        session()->save();
        
        Log::info('💾 Session saved', [
            'session_id' => session()->getId(),
            'session_user_id' => session('user_id'),
            'all_session' => session()->all()
        ]);
        
        $this->cachedUser = $user;
        $this->userResolved = true;
        
        if ($remember) {
            $token = Str::random(60);
            $user->update(['remember_token' => $token]);
            cookie()->queue('remember_token', $token, 60 * 24 * 30);
            Log::info('🍪 Remember token created');
        }
        
        Log::info('🔐 LOGIN END');
    }
    
    public function logout(): void
    {
        Log::info('🚪 LOGOUT', ['user_id' => session('user_id')]);
        
        session()->forget('user_id');
        session()->invalidate();
        session()->regenerateToken();
        cookie()->queue(cookie()->forget('remember_token'));
        
        $this->cachedUser = null;
        $this->userResolved = false;
    }
    
    public function user(): ?User
    {
        if ($this->userResolved) {
            Log::debug('📦 Returning cached user', [
                'user_id' => $this->cachedUser?->id
            ]);
            return $this->cachedUser;
        }
        
        Log::info('🔍 USER() CALLED - Resolving user');
        $this->userResolved = true;
        
        $userId = session('user_id');
        Log::info('📋 Session check', [
            'session_id' => session()->getId(),
            'user_id' => $userId,
            'has_session' => session()->has('user_id')
        ]);
        
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                Log::info('✅ User found from session', [
                    'user_id' => $user->id,
                    'role' => $user->role
                ]);
                $this->cachedUser = $user;
                return $user;
            }
            Log::warning('⚠️ Session has user_id but user not found in DB', ['user_id' => $userId]);
            session()->forget('user_id');
        }
        
        $token = request()->cookie('remember_token');
        if ($token) {
            Log::info('🍪 Trying remember token');
            $user = User::where('remember_token', $token)->first();
            if ($user) {
                Log::info('✅ User found from remember token', ['user_id' => $user->id]);
                session()->put('user_id', $user->id);
                session()->save();
                $this->cachedUser = $user;
                return $user;
            }
            Log::warning('⚠️ Invalid remember token');
            cookie()->queue(cookie()->forget('remember_token'));
        }
        
        Log::info('❌ No user found - GUEST');
        $this->cachedUser = null;
        return null;
    }
    
    public function check(): bool
    {
        $result = $this->user() !== null;
        Log::debug('✔️ check() = ' . ($result ? 'TRUE' : 'FALSE'));
        return $result;
    }
    
    public function guest(): bool
    {
        $result = !$this->check();
        Log::debug('👤 guest() = ' . ($result ? 'TRUE' : 'FALSE'));
        return $result;
    }
    
    public function hasRole(string $role): bool
    {
        $user = $this->user();
        return $user && $user->role === $role;
    }
}
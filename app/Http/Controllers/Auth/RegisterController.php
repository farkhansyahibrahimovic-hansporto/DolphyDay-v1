<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Show registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    /**
     * Handle registration request.
     * Returns JSON for AJAX requests, letting frontend handle redirect.
     */
    public function register(Request $request)
    {
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'name.required' => 'Nama lengkap wajib diisi',
                'name.max' => 'Nama lengkap maksimal 255 karakter',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Kata sandi wajib diisi',
                'password.min' => 'Kata sandi minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
            ]);
            
            // Log registration attempt
            Log::info('Registration attempt', [
                'name' => $validated['name'],
                'email' => $validated['email']
            ]);
            
            // Create user (always role='user')
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
            ]);
            
            // Log success
            Log::info('User registered successfully', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
            
            // Return JSON response - frontend akan handle redirect
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil!',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ], 201);
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors
            Log::warning('Registration validation failed', [
                'errors' => $e->errors()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            // Other errors
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'
            ], 500);
        }
    }
}
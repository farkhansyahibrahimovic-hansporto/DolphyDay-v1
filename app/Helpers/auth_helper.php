<?php

use App\Services\AuthService;
use App\Models\User;

if (!function_exists('auth')) {
    function auth(): AuthService
    {
        return app(AuthService::class);
    }
}

if (!function_exists('user')) {
    function user(): ?User
    {
        return app(AuthService::class)->user();
    }
}
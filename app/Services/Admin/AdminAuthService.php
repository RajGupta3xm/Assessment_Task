<?php
namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;

class AdminAuthService
{
    public function login(array $credentials): bool
    {
        return Auth::guard('admin')->attempt($credentials);
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();
    }
}

<?php
namespace App\Services\Customer;

use Illuminate\Support\Facades\Auth;

class CustomerAuthService
{
    public function login(array $credentials): bool
    {
        return Auth::guard('customer')->attempt($credentials);
    }

    public function logout(): void
    {
        Auth::guard('customer')->logout();
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\CustomerLoginRequest;
use App\Services\Customer\CustomerAuthService;

class AuthController extends Controller
{
    public function __construct(
        protected CustomerAuthService $authService
    ) {}
    public function loginForm()
    {
        return view('customer.auth.login');
    }
    public function login(CustomerLoginRequest $request)
    {
        if ($this->authService->login($request->validated())) {
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid customer credentials']);
    }

   public function logout()
    {
        $this->authService->logout();
        return redirect()->route('customer.login');
    }
}

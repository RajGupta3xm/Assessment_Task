<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Services\Admin\AdminAuthService;


class AuthController extends Controller
{
    public function __construct(
        protected AdminAuthService $authService
    ){}

    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        if ($this->authService->login($request->validated())) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials']);
    }
    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('admin.login');
    }
}

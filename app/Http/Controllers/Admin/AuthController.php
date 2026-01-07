<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Services\Admin\AdminAuthService;
use Illuminate\Support\Facades\Auth;
use App\Events\UserOffline;



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
   public function logout(Request $request)
{
    $user = Auth::guard('admin')->user();

    if ($user) {
        $user->update([
            'is_online' => 0,
            'last_seen_at' => now(),
        ]);

        // 🔥 BROADCAST ADMIN OFFLINE
        broadcast(new UserOffline($user, 'Admin'));
    }

    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}
}

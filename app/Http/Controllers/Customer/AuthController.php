<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\CustomerLoginRequest;
use App\Services\Customer\CustomerAuthService;
use Illuminate\Support\Facades\Auth;
use App\Events\UserOffline;
use App\Events\UserOnline;



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

        $user = auth('customer')->user();

        $user->update([
            'is_online' => 1,
            'last_seen_at' => now(),
        ]);

        // 🔥 REAL-TIME ONLINE PUSH
        broadcast(new UserOnline($user));

        return redirect()->route('customer.dashboard');
    }

    return back()->withErrors(['email' => 'Invalid customer credentials']);
}

public function logout(Request $request)
{
    $user = Auth::guard('customer')->user();

    if ($user) {
        $user->update([
            'is_online' => 0,
            'last_seen_at' => now(),
        ]);

        \Log::info('CUSTOMER LOGOUT → BROADCAST', ['id' => $user->id]);

        // broadcast(new UserOffline($user, 'Customer'))->toOthers();
        broadcast(new UserOffline($user, 'Customer'));

    }

    Auth::guard('customer')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('customer.login');
}


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::select('id','name','is_online','last_seen_at')->paginate(10);
         return view('admin.dashboard', compact('customers')    );
    }
}

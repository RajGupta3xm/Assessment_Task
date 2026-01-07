<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

Broadcast::channel('presence.online', function () {

    if (Auth::guard('admin')->check()) {
        $u = Auth::guard('admin')->user();
        return ['id'=>$u->id, 'name'=>$u->name, 'type'=>'Admin'];
    }

    if (Auth::guard('customer')->check()) {
        $u = Auth::guard('customer')->user();
        return ['id'=>$u->id, 'name'=>$u->name, 'type'=>'Customer'];
    }

    return false;
});

<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Events\UserOffline;


class MarkUserOffline
{
    public function handle(Logout $event): void
    {
        $user = $event->user;

        if ($user) {

            $type = $user instanceof \App\Models\Admin ? 'Admin' : 'Customer';

            $user->update([
                'is_online' => 0,
                'last_seen_at' => now(),
            ]);

            // ✅ FIX: 2 arguments pass karo
            broadcast(new UserOffline($user, $type))->toOthers();
        }
    }
}

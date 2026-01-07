<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;  
use App\Events\UserOnline; 

class MarkUserOnline
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
   public function handle(Login $event): void
    {
        $user = $event->user;

        $user->update([
            'is_online'    => true,
            'last_seen_at' => now(),
        ]);

        broadcast(new UserOnline($user));
    }
}

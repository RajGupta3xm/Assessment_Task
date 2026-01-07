<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOnline implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $id;
    public $type;

    public function __construct($user)
    {
        $this->id = $user->id;
        $this->type = class_basename($user); // Customer / Admin
    }

    public function broadcastOn()
    {
        return new Channel('test-channel');   // 🔥 same channel
    }

    public function broadcastAs()
    {
        return 'user.online';
    }
}

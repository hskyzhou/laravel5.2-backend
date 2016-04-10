<?php

namespace App\Events\Backend;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddPermissionEvent extends Event
{
    use SerializesModels;

    public $user;
    public $permissions;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\User $user, $permissions)
    {
        $this->user = $user;
        $this->permissions = $permissions;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}

<?php

namespace App\Events\Backend;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddRoleEvent extends Event
{
    use SerializesModels;

    public $user;
    public $roles;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\User $user, $roles)
    {
        $this->user = $user;
        $this->roles = $roles;
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

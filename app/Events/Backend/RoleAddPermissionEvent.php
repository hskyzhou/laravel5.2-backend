<?php

namespace App\Events\Backend;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RoleAddPermissionEvent extends Event
{
    use SerializesModels;

    public $role;
    public $permissions;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($role, $permissions)
    {
        $this->role = $role;
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

<?php

namespace App\Events\Backend;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


use App\User;

/**
 * 给用户绑定权限
 * 
 * @author        xezw211@gmail.com
 * 
 * @date        2016-04-11 09:22:15
 */

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
    public function __construct(User $user, $permissions)
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

<?php

namespace App\Events\Backend;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
/**
 * 给用户绑定角色
 * 
 * @author        xezw211@gmail.com
 */

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
    public function __construct(User $user, $roles)
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

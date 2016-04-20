<?php

namespace App\Listeners\Backend;

use App\Events\Backend\UserAddPermissionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserAddPermissionEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserAddPermissionEvent  $event
     * @return void
     */
    public function handle(UserAddPermissionEvent $event)
    {
        $user = $event->user;
        $permissions = $event->permissions;

        if($permissions && !$permissions->isEmpty()){
            foreach($permissions as $permission){
                $user->attachPermission($permission);
            }
        }
    }
}

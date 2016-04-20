<?php

namespace App\Listeners\Backend;

use App\Events\Backend\RoleAddPermissionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RoleAddPermissionEventListener
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
     * @param  RoleAddPermissionEvent  $event
     * @return void
     */
    public function handle(RoleAddPermissionEvent $event)
    {
        $role = $event->role;
        $permissions = $event->permissions;

        if($permissions && !$permissions->isEmpty()){
            foreach($permissions as $permission){
                $role->attachPermission($permission);
            }
        }
    }
}

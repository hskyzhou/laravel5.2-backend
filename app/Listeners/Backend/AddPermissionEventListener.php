<?php

namespace App\Listeners\Backend;

use App\Events\Backend\AddPermissionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPermissionEventListener
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
     * @param  AddPermissionEvent  $event
     * @return void
     */
    public function handle(AddPermissionEvent $event)
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

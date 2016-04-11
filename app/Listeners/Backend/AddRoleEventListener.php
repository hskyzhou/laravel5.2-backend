<?php

namespace App\Listeners\Backend;

use App\Events\Backend\AddRoleEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddRoleEventListener
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
     * @param  AddRoleEvent  $event
     * @return void
     */
    public function handle(AddRoleEvent $event)
    {
        $user = $event->user;
        $roles = $event->roles;

        if($roles && !$roles->isEmpty()){
            foreach($roles as $role){
                $user->attachRole($role);
            }
        }
    }
}

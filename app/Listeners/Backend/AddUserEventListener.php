<?php

namespace App\Listeners\Backend;

use App\Events\Backend\AddUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use UserRepo;

class AddUserEventListener
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
     * @param  AddUserEvent  $event
     * @return void
     */
    public function handle(AddUserEvent $event)
    {
        return UserRepo::createUser($event->userData);
    }
}

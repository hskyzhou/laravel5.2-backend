<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*添加用户*/
        'App\Events\Backend\AddUserEvent' => [
            'App\Listeners\Backend\AddUserEventListener',
        ],
        /*添加角色*/
        'App\Events\Backend\AddRoleEvent' => [
            'App\Listeners\Backend\AddRoleEventListener',
        ],
        /*添加权限*/
        'App\Events\Backend\AddPermissionEvent' => [
            'App\Listeners\Backend\AddPermissionEventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}

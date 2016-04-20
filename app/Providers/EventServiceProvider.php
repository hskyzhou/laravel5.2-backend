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
        /*用户添加角色*/
        'App\Events\Backend\UserAddRoleEvent' => [
            'App\Listeners\Backend\UserAddRoleEventListener',
        ],

        /*用户添加权限*/
        'App\Events\Backend\UserAddPermissionEvent' => [
            'App\Listeners\Backend\UserAddPermissionEventListener',
        ],

        /*角色添加权限*/
        'App\Events\Backend\RoleAddPermissionEvent' => [
            'App\Listeners\Backend\RoleAddPermissionEventListener',
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

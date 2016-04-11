<?php

namespace App;
    
use Illuminate\Foundation\Auth\User as Authenticatable;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

use App\Traits\ModelTrait;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use ModelTrait;
    use HasRoleAndPermission;

    protected $type = 'admin.user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

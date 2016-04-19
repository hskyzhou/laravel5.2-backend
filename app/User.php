<?php

namespace App;
    
use Illuminate\Foundation\Auth\User as Authenticatable;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

use App\Traits\ButtonTrait;
use App\Traits\FieldTrait;

class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use ButtonTrait, FieldTrait;
    use HasRoleAndPermission;

    protected $prefix = 'admin.';
    protected $type = 'user.';
    
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
        'password', 
        'remember_token',
    ];
}

<?php

namespace App\Models;

use Bican\Roles\Models\Role as BicanRole;

use App\Traits\ModelTrait;

class Role extends BicanRole
{
    use ModelTrait;

    protected $type = 'admin.role';
}

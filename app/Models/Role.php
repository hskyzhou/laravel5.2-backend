<?php

namespace App\Models;

use Bican\Roles\Models\Role as BicanRole;

use App\Traits\ButtonTrait;
use App\Traits\FieldTrait;

class Role extends BicanRole
{
    use ButtonTrait, FieldTrait;

    protected $prefix = 'admin.';
    protected $type = 'role.';
}

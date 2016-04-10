<?php

use Illuminate\Database\Seeder;

use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*用户*/
        Permission::create([
        	'name' => '管理用户',
        	'slug' => 'user.manage',
        	'description' => '管理用户',
        	'model' => 'App\Models\User',
        ]);

        Permission::create([
        	'name' => '添加用户',
        	'slug' => 'user.create',
        	'description' => '添加用户',
        	'model' => 'App\Models\User',
        ]);

        Permission::create([
        	'name' => '修改用户',
        	'slug' => 'user.update',
        	'description' => '修改用户',
        	'model' => 'App\Models\User',
        ]);

        Permission::create([
        	'name' => '删除用户',
        	'slug' => 'user.delete',
        	'description' => '删除用户',
        	'model' => 'App\Models\User',
        ]);

        /*角色*/
        Permission::create([
        	'name' => '管理角色',
        	'slug' => 'role.manage',
        	'description' => '管理角色',
        	'model' => 'App\Models\Role',
        ]);

        Permission::create([
        	'name' => '添加角色',
        	'slug' => 'role.create',
        	'description' => '添加角色',
        	'model' => 'App\Models\Role',
        ]);

        Permission::create([
        	'name' => '修改角色',
        	'slug' => 'role.update',
        	'description' => '修改角色',
        	'model' => 'App\Models\Role',
        ]);

        Permission::create([
        	'name' => '删除角色',
        	'slug' => 'role.delete',
        	'description' => '删除角色',
        	'model' => 'App\Models\Role',
        ]);

        /*菜单*/
        Permission::create([
            'name' => '管理菜单',
            'slug' => 'menu.manage',
            'description' => '管理菜单',
            'model' => 'App\Models\Menu',
        ]);

        Permission::create([
            'name' => '添加菜单',
            'slug' => 'menu.create',
            'description' => '添加菜单',
            'model' => 'App\Models\Menu',
        ]);

        Permission::create([
            'name' => '修改菜单',
            'slug' => 'menu.update',
            'description' => '修改菜单',
            'model' => 'App\Models\Menu',
        ]);

        Permission::create([
            'name' => '删除菜单',
            'slug' => 'menu.delete',
            'description' => '删除菜单',
            'model' => 'App\Models\Menu',
        ]);
    }
}

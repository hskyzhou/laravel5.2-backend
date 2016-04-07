<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'admin',
        	'slug' => 'admin',
        	'description' => 'adminstrator',
        	'level' => 1,
        ]);

        Role::create([
        	'name' => 'user',
        	'slug' => 'user',
        	'description' => 'user',
        	'level' => 10,
        ]);
    }
}

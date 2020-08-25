<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {		
    	// in staff
        $role = new Role;
        $role->name = 'admin';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role;
        $role->name = 'reservation staff';
        $role->guard_name = 'web';
        $role->save();
        
        $role = new Role;
        $role->name = 'service staff';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role;
        $role->name = 'chef';
        $role->guard_name = 'web';
        $role->save();

        // in guest
        $role = new Role;
        $role->name = 'guest';
        $role->guard_name = 'web';
        $role->save();
    }
}

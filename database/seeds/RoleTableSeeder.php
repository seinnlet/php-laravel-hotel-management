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
        $role->name = 'Admin';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role;
        $role->name = 'Reservation Staff';
        $role->guard_name = 'web';
        $role->save();
        
        $role = new Role;
        $role->name = 'Service Staff';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role;
        $role->name = 'Chef';
        $role->guard_name = 'web';
        $role->save();

        // in guest
        $role = new Role;
        $role->name = 'Guest';
        $role->guard_name = 'web';
        $role->save();
    }
}

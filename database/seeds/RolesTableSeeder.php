<?php

use Inayat\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = new Role();
        $userRole->name = "Member";
        $userRole->description = "A regular user role";
        $userRole->save();

        $customerServiceRole = new Role();
        $customerServiceRole->name = "Developer";
        $customerServiceRole->description = "A developer service role";
        $customerServiceRole->save();

        $adminRole = new Role();
        $adminRole->name = "Administrator";
        $adminRole->description = "An admin user role";
        $adminRole->save();
    }
}

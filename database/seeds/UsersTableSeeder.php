<?php

use Inayat\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->surname = "Akande";
        $user->firstName = "Suraj";
        $user->middleName = "Adeyemi";
        $user->phone = 8037690966;
        $user->password = Hash::make(12345678);
        $user->registration = 234994234;
        $user->sex = "male";
        $user->status = 1;
        $user->role = 2;
        $user->save();
    }
}

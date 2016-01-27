<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Profile;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'Admin', 'permission'=>25]);
        Role::create(['name'=>'Teacher', 'permission'=>15]);
        Role::create(['name'=>'Student', 'permission'=>5]);
        User::create(['role_id'=>1, 'username'=>'admin', 'password'=>bcrypt('sample'), 'active'=>1]);
    }
}

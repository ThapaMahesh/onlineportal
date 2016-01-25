<?php

use Illuminate\Database\Seeder;
use App\User;
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
        User::create(['role_id'=>1, 'username'=>'admin', 'password'=>bcrypt('sample'), 'active'=>1]);
        User::create(['role_id'=>2, 'username'=>'teacher1', 'password'=>bcrypt('sample'), 'active'=>1]);
        User::create(['role_id'=>2, 'username'=>'teacher2', 'password'=>bcrypt('sample'), 'active'=>1]);
        User::create(['role_id'=>3, 'username'=>'student', 'password'=>bcrypt('sample'), 'active'=>1]);

    }
}

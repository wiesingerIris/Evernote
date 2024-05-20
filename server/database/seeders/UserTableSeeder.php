<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // test user
        $user = new User;
        $user->first_name = 'test';
        $user->sur_name = 'user';
        $user->email = 'test@gmail.com';
        $user->role = 'admin';
        $user->password = bcrypt('secret');
        $user->save();
        $admin = new User;
        $admin->first_name = 'admin';
        $admin->sur_name = 'user';
        $admin->email = 'admin@gmail.com';
        $admin->role = 'admin';
        $admin->password = bcrypt('secret');
        $admin->save();
        $user1 = new User;
        $user1->first_name = 'user';
        $user1->sur_name = 'user';
        $user1->role = 'user';
        $user1->email = 'user@gmail.com';
        $user1->password = bcrypt('secret');
        $user1->save();
    }


}

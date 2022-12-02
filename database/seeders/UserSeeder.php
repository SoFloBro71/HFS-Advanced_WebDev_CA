<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // grabs admin role from the role table
        $role_admin = Role::where('name', 'admin')->first();

        // grabs the user role from the role table
        $role_user = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Hannah FS';
        $admin->email = 'N00211013@iadt.ie';
        $admin->password = Hash::make('password');
        $admin->save();

        
        // this links the admin role to the user make above
        $admin->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Oopie Spoopie';
        $user->email = 'N0021@iadt.ie';
        $user->password = Hash::make('password');
        $user->save();

        // this links the user role to the user make above
        $user->roles()->attach($role_user);
    }

}
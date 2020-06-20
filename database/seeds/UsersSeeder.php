<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();

        DB::table('role_user')->truncate();

        // get instances role from db
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $managerRole = Role::where('name', 'manager')->first();

        // create users and attach ther roles
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@pts.com',
            'password' => Hash::make('admin')
            ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@pts.com',
            'password' => Hash::make('agent')
            ]);

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@pts.com',
            'password' => Hash::make('manager')
            ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
        $manager->roles()->attach($managerRole);
    }
}

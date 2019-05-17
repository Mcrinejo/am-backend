<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name','user')->first();
        $role_admin = Role::where('name','admin')->first();

        $user = new User();
        $user->name = 'User';
        $user->mail = 'user@mail.com';
        $user->password = bcrypt('query');
        $user->confirmation_code = (string) Str::uuid();
        $user->save();
        $user->roles()->attach($role_user);


        $user = new User();
        $user->name = 'Admin';
        $user->mail = 'admin@mail.com';
        $user->password = bcrypt('query');
        $user->confirmation_code = (string) Str::uuid();
        $user->save();
        $user->roles()->attach($role_admin);     
    }
}
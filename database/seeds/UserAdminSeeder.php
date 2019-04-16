<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            't_number' => 1475,
            'password' => Hash::make('password'),
        ]);

        Role::create([
            'user_id'        => $user->id,
            'is_super_admin' => true
        ]);

    }
}

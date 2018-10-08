<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Example Admin',
                'email' => 'admin@contractzero.com',
                'password' => 'qwert123',
                'role_id' => 1,
            ],
            [
                'name' => 'Example user',
                'email' => 'user@contractzero.com',
                'password' => 'qwert123',
            ],
        ];

        foreach ($users as $userData) {
            $user = new \App\User();

            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);
            $user->role_id = $userData['role_id'] ?? 2;

            $user->save();
        }
    }
}

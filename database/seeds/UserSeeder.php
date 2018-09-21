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
                'name' => 'Contract Zero',
                'email' => 'info@contractzero.com',
                'password' => 'qwert123',
            ],
            [
                'name' => 'Giga Gatenashvili',
                'email' => 'gg@contractzero.com',
                'password' => 'qwert123',
            ],
        ];

        foreach ($users as $userData) {
            $user = new \App\User();

            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->password = bcrypt($userData['password']);

            $user->save();
        }
    }
}

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
        $user = new \App\User();

        $user->name = 'Contract Zero';
        $user->email = 'info@contractzero.com';
        $user->password = bcrypt('qwert123');

        $user->save();
    }
}

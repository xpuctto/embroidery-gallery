<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'firstname' => 'Admin',
                'lastname' => 'Admin',
                'password' => 'admin',
                'email' => 'admin@admin.admin'
            ]);
    }
}

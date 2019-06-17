<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name'      => 'Deivid Santos',
        	'email'     => 'deividluiz.santos@hotmail.com',
        	'password'  => bcrypt('123456'),
        ]);

         User::create([
            'name'      => 'Tatiane Santos',
            'email'     => 'tatiane.santos0302@gmail.com',
            'password'  => bcrypt('123456'),
        ]);

    }
}

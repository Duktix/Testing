<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => '1',
                'name' => 'first1 last1',
                'email' => 'jbora201@gmail.com',
                'password' => '$2y$10$tUXqS76Y50zAj19/botz4OFK9aB7vYBZCkIdZvr0gcfa/R1DLFDTe',
                'role' => 'admin',
                'remember_token' => NULL,
                'created_at' => '2017-11-24 19:39:21',
                'updated_at' => '2017-11-24 19:39:21',
            ),
        ));
        
        
    }
}
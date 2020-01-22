<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
        	'id' => 1,
            'username' => 'ihza',
            'password' => bcrypt('123'),
            'role' => 1,
        ]);

        DB::table('user')->insert([
            'id' => 2,
            'username' => 'eko',
            'password' => bcrypt('123'),
            'role' => 2,
        ]);

        DB::table('user')->insert([
            'id' => 3,
            'username' => 'evi',
            'password' => bcrypt('123'),
            'role' => 3,
        ]);
    }
}

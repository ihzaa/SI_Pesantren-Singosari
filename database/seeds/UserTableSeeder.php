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
            'username' => 'pondok',
            'password' => bcrypt('surga'),
            'role' => 1,
        ]);
    }
}

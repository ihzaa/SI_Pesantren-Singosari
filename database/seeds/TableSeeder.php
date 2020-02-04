<?php

use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'id' => 1,
            'nama' => 'ihza',
            'email' => 'ihzaahmad@gmail.com',
            'id_user' => 1,
        ]);

        DB::table('donasi')->insert([
            'id' => 1,
            'Target' => 1,
            'judul' => 'judul disini',
            'deskripsi' => 'disini deskripsi',
            'foto' => '/donasi/foto.jpg',
        ]);
    }
}

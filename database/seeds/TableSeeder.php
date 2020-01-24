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

        DB::table('pengajar')->insert([
            'id' => 1,
            'nama' => '3K0 5U6eNg',
            'nip' => '43223423',
            'jenis_kelamin' => 'p',
            'tempat_lahir' => 'tulungageng',
            'tanggal_lahir' => '1999-01-01',
            'email' => 'saiyaekoh@gmail.com',
            'telp' => '90821',
            'id_user' => 2,
        ]);

        DB::table('santri')->insert([
            'id' => 1,
            'nama' => '3V1 F3bR!0n',
            'nis' => '008',
            'jenis_kelamin' => 'p',
            'tempat_lahir' => 'tulungageng',
            'tanggal_lahir' => '1999-02-25',
            'telp' => '891273712',
            'alamat' => 'tulungageng',
            'tahun_masuk' => '2017',
            'nama_wali' => 'mus',
            'telp_wali' => '9080890',
            'id_user' => 3,
        ]);
    }
}

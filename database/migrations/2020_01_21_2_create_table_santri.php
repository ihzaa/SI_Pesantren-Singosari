<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSantri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nis')->unique();
            $table->set('jenis_kelamin', ['l', 'p']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('telp');
            $table->string('alamat');
            $table->string('tahun_masuk', 6);
            $table->string('nama_wali');
            $table->string('telp_wali');
            $table->unsignedBigInteger('id_user');
            $table->string('foto')->default('user/santri/default.png');
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('santri');
    }
}

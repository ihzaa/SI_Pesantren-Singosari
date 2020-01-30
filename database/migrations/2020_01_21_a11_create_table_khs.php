<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKhs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nilai');
            $table->unsignedBigInteger('id_santri');
            $table->unsignedBigInteger('id_kelas_tahun_ajaran');
            $table->unsignedBigInteger('id_mata_pelajaran_tahun_ajaran');
            $table->foreign('id_santri')->references('id')->on('santri')->onDelete('cascade');
            $table->foreign('id_kelas_tahun_ajaran')->references('id')->on('kelas_tahun_ajaran')->onDelete('cascade');
            $table->foreign('id_mata_pelajaran_tahun_ajaran')->references('id')->on('mata_pelajaran_tahun_ajaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khs');
    }
}

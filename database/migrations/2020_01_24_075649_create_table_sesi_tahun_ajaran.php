<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSesiTahunAjaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_tahun_ajaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->foreign('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->onDelete('cascade');
            $table->unsignedBigInteger('id_kelas');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesi_tahun_ajaran');
    }
}

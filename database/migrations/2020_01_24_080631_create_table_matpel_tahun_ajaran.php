<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMatpelTahunAjaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_pelajaran_tahun_ajaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->foreign('id_mata_pelajaran')->references('id')->on('mata_pelajaran')->onDelete('cascade');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->foreign('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matpel_tahun_ajaran');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_artikels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('path');
            $table->unsignedBigInteger('id_artikel');
            $table->foreign('id_artikel')->references('id')->on('artikels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_artikels');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDonasiMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasi_masuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dari_rekening');
            $table->string('nominal');
            $table->dateTime('dibuat')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donasi_masuk');
    }
}

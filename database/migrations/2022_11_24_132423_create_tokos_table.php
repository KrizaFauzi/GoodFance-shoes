<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned()->unique();
            $table->foreign('seller_id')->references('id')->on('users');
            $table->string('nama_toko');
            $table->time('waktu_buka', $precision = 0);
            $table->time('waktu_tutup', $precision = 0);
            $table->string('photo_profile');
            $table->string('background');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toko');
    }
};

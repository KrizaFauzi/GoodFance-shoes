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
        Schema::create('cart_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('cart');
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
            $table->integer("seller_id")->unsigned();
            $table->foreign("seller_id")->references('id')->on('users');
            $table->string('nama_produk');
            $table->string('nama_pembeli');
            $table->string('nama_seller');
            $table->string('warna')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('catatan')->nullable();
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('total');
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
        Schema::dropIfExists('cart_detail');
    }
};

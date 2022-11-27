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
        Schema::create('checkout', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("produk_id")->unsigned();
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->integer("order_id")->unsigned();
            $table->foreign('order_id')->references('id')->on('order');
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
            $table->integer("cart_id")->unsigned();
            $table->foreign("cart_id")->references('id')->on('cart');
            $table->integer("seller_id")->unsigned();
            $table->foreign("seller_id")->references('id')->on('users');
            $table->integer("alamat_id")->unsigned();
            $table->foreign("alamat_id")->references('id')->on('alamat_pengiriman');
            $table->string('invoice');
            $table->string('nama_pembeli');
            $table->string('nama_seller');
            $table->string('nama_produk');
            $table->string('alamat');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('total');
            $table->string('status');
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
        Schema::dropIfExists('checkout');
    }
};

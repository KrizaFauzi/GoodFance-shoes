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
        Schema::create('cart', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("produk_id")->unsigned();
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->integer('qty');
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
            $table->integer("seller_id")->unsigned();
            $table->foreign("seller_id")->references('id')->on('users');
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
        Schema::dropIfExists('carts');
    }
};

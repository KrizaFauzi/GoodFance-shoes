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
        Schema::create('promoted_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produk_id')->unsigned();
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->integer('promo_id')->unsigned();
            $table->foreign('promo_id')->references('id')->on('promo');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('harga_awal', 16,2)->default(0);
            $table->decimal('harga_akhir', 16,2)->default(0);
            $table->decimal('diskon_nominal', 16,2)->default(0);
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
        Schema::dropIfExists('promoted_produk');
    }
};

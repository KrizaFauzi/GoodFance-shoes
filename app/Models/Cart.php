<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'produk_id',
        'seller_id',
        'qty'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function produk(){
        return $this->belongsTo('App\Models\Produk','produk_id');
    }

    public function seller(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}

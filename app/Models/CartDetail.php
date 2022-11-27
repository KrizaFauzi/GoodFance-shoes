<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_detail';
    protected $fillable = [
        'cart_id',
        'user_id',
        'seller_id',
        'nama_produk',
        'nama_pembeli',
        'nama_seller',
        'warna',
        'ukuran',
        'catatan',
        'qty',
        'harga',
        'total'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart() {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }
}

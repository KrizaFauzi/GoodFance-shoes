<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    use HasFactory;
    protected $table = 'checkout';
    protected $fillable = [
        'invoice',
        'order_id',
        'user_id',
        'cart_id',
        'produk_id',
        'seller_id',
        'alamat_id',
        'nama_pembeli',
        'nama_seller',
        'nama_produk',
        'alamat',
        'harga',
        'qty',
        'total',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}

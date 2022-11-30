<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\AlamatPengiriman;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function pengiriman(){
        return $this->belongsTo(AlamatPengiriman::class,'alamat_id');
    }
}

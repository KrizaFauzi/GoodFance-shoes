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
        'status'
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

    public function CartDetail(){
        return $this->hasOne(CartDetail::class);
    }

    public function total($param){
        if($param != 'total'){
            return 0;
        }
        $cart = Cart::where('status', 'cart')->get();
        $allTotal = 0;
        foreach($cart as $cart){
           $allTotal = (int) $allTotal + $cart->CartDetail->total;
        }
        return $allTotal;
    }

    public function qtyTotal($param){
        if($param != 'total'){
            return 0;
        }
        $cart = Cart::where('status', 'cart')->get();
        $qty = 0;
        foreach($cart as $cart){
           $qty = (int) $qty + $cart->CartDetail->qty;
        }
        return $qty;
    }
}

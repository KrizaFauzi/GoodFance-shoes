<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Rating;
use App\Models\Checkout;
use App\Models\ukuran;
use App\Models\Warna;
use App\Models\wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'kategori_id',
        'user_id',
        'kode_produk',
        'nama_produk',
        'slug_produk',
        'deskripsi_produk',
        'foto',
        'qty',
        'satuan',
        'harga',
        'status',
    ];

    public function kategori() {
        return $this->belongsTo('App\Models\Kategori', 'kategori_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function images() {
        return $this->hasMany('App\Models\ProdukImage', 'produk_id');
    }

    public function promoted_produk(){
        return $this->hasOne(promoted_produk::class,'produk_id','id');
    } 

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function rating(){
        return $this->hasMany(Rating::class, 'produk_id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    
    public function warna(){
        return $this->hasMany(Warna::class, 'produk_id');
    }

    public function ukuran(){
        return $this->hasMany(ukuran::class, 'produk_id');
    }

    public function wish($id, $pid){
        $wish = Wishlist::where('user_id', $id)->where('produk_id', $pid)->first();
        return $wish;
    }

    
}

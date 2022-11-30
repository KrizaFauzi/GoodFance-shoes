<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Warna;
use App\Models\Rating;
use App\Models\ukuran;
use App\Models\Checkout;
use App\Models\wishlist;
use Illuminate\Support\Carbon;
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

    public function dibeli($uId, $pId){
        $checkout = Checkout::where('user_id', $uId)->where('produk_id', $pId)->orderBy('created_at', 'DESC')->first();
        if($checkout == null){
            return false;
        }
        $tanggalDipesan =  date_format($checkout->created_at, "Y/m/d");
        $thenDate = date("Y/m/d", strtotime($tanggalDipesan. ' + 3 days'));
        $mytime = Carbon::now()->format('Y/m/d');
        if($mytime > $thenDate){
            return false;
        }
        return true;
    }

    public function tanggalDibeli($uId, $pId){
        $checkout = Checkout::where('user_id', $uId)->where('produk_id', $pId)->orderBy('created_at', 'DESC')->first();
        $tanggalDipesan =  date_format($checkout->created_at, "d-m-Y");
        return $tanggalDipesan;
    }

}

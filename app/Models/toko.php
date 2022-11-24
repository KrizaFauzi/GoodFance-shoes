<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;
    protected $table = 'toko';
    protected $fillable = [
        'seller_id',
        'nama_toko',
        'waktu_buka',
        'waktu_tutup',
        'photo_profile',
        'background'
    ];

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function produk(){
        return $this->hasMany(Produk::class, 'seller_id', 'id');
    }

    public function rating($sid){
        $produk = Produk::where('user_id', $sid)->get();
        $averangeRating = 0;
        $iteration = 0;
        foreach($produk as $produk){
            if($produk->rating->avg('rating')){
                $iteration++;
            }
            $averangeRating = $averangeRating + $produk->rating->avg('rating');
        }
        $rating = $averangeRating / $iteration;
        return (int) $rating;
    }

    public function penjualan($idt){
        $penjualan = Checkout::where('seller_id', $idt)->where('status','diterima')->count();
        return $penjualan;
    }

}

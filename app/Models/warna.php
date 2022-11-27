<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warna extends Model
{
    use HasFactory;
    protected $table = 'warna';
    protected $fillable = [
        'seller_id',
        'produk_id',
        'warna'
    ];

    public function seller(){
        return $this->belongsTo(User::Class, 'seller_id', 'id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}

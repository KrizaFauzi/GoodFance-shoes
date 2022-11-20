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
        'user_id',
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
}

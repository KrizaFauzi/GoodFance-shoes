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
        'nama_pembeli',
        'nama_seller',
        'nama_produk',
        'qty',
        'total',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ukuran extends Model
{
    use HasFactory;
    protected $table = 'ukuran';

    protected $fillable = [
        'seller_id',
        'produk_id',
        'ukuran'
    ];

    public function seller(){
        return $this->belongsTo(User::Class, 'seller_id', 'id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating';
    protected $fillable = [
        'user_id',
        'produk_id',
        'rating',
        'ulasan'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}

<?php

namespace App\Models;

use App\Models\promoted_produk;
use Illuminate\Database\Eloquent\Model;

class ProdukPromo extends Model
{
    protected $table = 'promo';
    protected $fillable = [
        'nama_promo',
        'diskon_persen',
        'user_id',
        'event_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function promoted_produk(){
        return $this->hasMany(promoted_produk::class, 'promo_id');
    }
}
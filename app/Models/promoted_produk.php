<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProdukPromo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class promoted_produk extends Model
{
    use HasFactory;
    protected $table = 'promoted_produk';
    protected $fillable = [
        'produk_id',
        'promo_id',
        'harga_awal',
        'harga_akhir',
        'diskon_nominal',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    public function promo()
    {
        return $this->belongsTo(ProdukPromo::class, 'promo_id', 'id');
    }
}

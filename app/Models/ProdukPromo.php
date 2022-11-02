<?php

namespace App\Models;

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
}
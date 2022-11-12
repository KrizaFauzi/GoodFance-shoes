<?php

namespace App\Models;

use App\Models\DaftarEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    protected $table = "event";
    protected $fillable = [
        'user_id',
        'nama_event',
        'deskripsi',
        'status',
        'slug_event',
        'tanggal_awal',
        'tanggal_akhir'
    ];

    public function user(){
        return $this->belongsTo('App\Models\user', 'user_id', 'id');
    }

    public function userDaftar(){
        return $this->hasMany(DaftarEvent::class);
    }
}

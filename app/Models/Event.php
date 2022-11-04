<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "event";
    protected $fillable = [
        'user_id',
        'nama_event',
        'deskripsi',
        'slug_event',
        'tanggal_awal',
        'tanggal_akhir',
    ];

    public function user(){
        return $this->belongsTo('App\Models\user', 'user_id', 'id');
    }

    public function userDaftar(){
        return $this->hasMany('App\Models\DaftarEvent', 'event_id', 'id');
    }
}

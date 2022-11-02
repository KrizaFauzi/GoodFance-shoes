<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarEvent extends Model
{
    protected $table = "daftar_event";
    protected $fillable = [
        'user_id',
        'user_name',
        'event_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function event(){
        return $this->belongsTo('App\Models\Event', 'event_id');
    }
}

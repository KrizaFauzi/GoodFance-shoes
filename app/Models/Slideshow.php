<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table = "slideshow";
    protected $fillable = [
        'foto',
        'caption_title',
        'event_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function event(){
        return $this->belongsTo('App\Models\Event', 'event_id');
    }
}
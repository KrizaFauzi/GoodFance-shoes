<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Toko;
use App\Models\DaftarEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'level', 'foto', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function event(){
        return $this->hasMany(Event::class);
    }

    public function user_event(){
        return $this->hasMany(DaftarEvent::class, 'user_id', 'id');
    }

    public function toko(){
        return $this->hasOne(Toko::class, 'seller_id', 'id');
    }

    public function rating($id,$idp){
        $rate = Rating::where('user_id',$id)->where('produk_id', $idp)->first();
        return $rate;
    }
}
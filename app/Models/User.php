<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    public function rentals(){
        return $this->hasMany('App\Models\Rental');
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }
}

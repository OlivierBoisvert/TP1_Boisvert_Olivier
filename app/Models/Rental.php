<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'startDate',
        'endDate',
        'totalPrice'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function equipment(){
        return $this->belongsTo('App\Models\Equipment');
    }

    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }
}

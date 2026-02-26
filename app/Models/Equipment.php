<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'daily_price'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function rentals(){
        return $this->hasMany('App\Model\Rental');
    }

    public function sports(){
        return $this->belongsToMany('App\Models\Sport');
    }
}

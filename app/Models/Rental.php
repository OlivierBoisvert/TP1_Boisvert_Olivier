<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Rental extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'total_price'
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

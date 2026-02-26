<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Review extends Model
{
    protected $fillable = [
        'rating',
        'comment'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function rental(){
        return $this->belongsTo('App\Models\Rental');
    }
}

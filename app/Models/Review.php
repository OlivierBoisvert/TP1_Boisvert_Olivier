<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'rental_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function rental(){
        return $this->belongsTo('App\Models\Rental');
    }
}

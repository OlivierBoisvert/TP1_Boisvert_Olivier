<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Rental;

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
        return $this->belongsTo(User::class);
    }

    public function rental(){
        return $this->belongsTo(Rental::class);
    }
}

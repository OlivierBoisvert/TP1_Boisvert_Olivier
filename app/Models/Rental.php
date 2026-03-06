<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Equipment;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'total_price',
        'user_id',
        'equipment_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Sport extends Model
{
    protected $fillable = [
        'name'
    ];

    public function equipment(){
        return $this->belongsToMany("App\Models\Equipment");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BSS extends Model
{
    use HasFactory;

    protected $table = "BSS";

    public function category(){
        return $this->belongsTo('App\Category')->withTimestamps();
    }
}

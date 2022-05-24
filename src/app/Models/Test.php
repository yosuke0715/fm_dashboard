<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = "tests";

    public function user(){
        return $this->belongsTo('App\User')->withTimestamps();
    }
}

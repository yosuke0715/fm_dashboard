<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BSS extends Model
{
    use HasFactory;

    protected $table = "BSS";

    protected $fillable = [
        'category_id',
        'title',
        'level',
        'note',
        'deleted_at'
    ];

    public function category(){
        return $this->belongsTo('App\Category')->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = [
        'name'
    ];

    public function bss(){
        return $this->hasMany('App\BSS', 'category_id');
    }
}

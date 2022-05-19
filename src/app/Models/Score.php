<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = "score";
    protected $fillable = [
        'user_id',
        'BSS_id',
        'name',
        'description',
        'score'
    ];
}

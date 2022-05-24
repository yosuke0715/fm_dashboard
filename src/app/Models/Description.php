<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $table = "descriptions";

    protected $fillable = [
      'user_id',
      'BSS_id',
      'description'
    ];

    public function user(){
        return $this->belongsTo('App\User')->withTimestamps();
    }

    public static function CreateDescription($user_id, $BSS_id, $description){
        return self::create([
            'user_id' => $user_id,
            'BSS_id' => $BSS_id,
            'description' => $description,
        ]);
    }
}

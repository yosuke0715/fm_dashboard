<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achieve extends Model
{
    use HasFactory;
    protected $table = "achieve";

    public function user(){
        return $this->belongsTo('App\User')->withTimestamps();
    }

    public function bss(){
        return $this->belongsTo('App\BSS')->withTimestamps();
    }
    public static function CountAchievement($user_id, $achieve_id){
        return self::where('user_id', $user_id)->where('achievement', $achieve_id)->count();
    }
}

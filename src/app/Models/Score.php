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

    /**
     * BSS解釈を策栄する
     * @param $user_id
     * @param $BSS_id
     * @param $name
     * @param $description
     * @return mixed
     */
    public static function CreateBSSDescription($user_id, $BSS_id, $name, $description){
        return self::create([
            'user_id' =>  $user_id,
            'BSS_id' => $BSS_id,
            'name' => $name,
            'description' => $description
        ]);
    }

    public static function GetBSSScore(){
        return self::leftjoin('users', 'users.id', '=', 'score.user_id')
            ->select('score.id as id', 'score.user_id', 'score.name as title', 'score.BSS_id', 'score.description', 'users.name')
            ->whereNull('deleted_at')->get();
    }

}

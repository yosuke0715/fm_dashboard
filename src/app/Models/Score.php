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

    public function user(){
        return $this->belongsTo('App\User')->withTimestamps();
    }

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

    /**
     * BSSの解釈添削対象を取得
     * @return mixed
     */
    public static function GetBSSScore(){
        return self::leftjoin('users', 'users.id', '=', 'score.user_id')
            ->select('score.id as id', 'score.user_id', 'score.name as title', 'score.BSS_id', 'score.description', 'users.name')
            ->whereNull('deleted_at')->get();
    }

    /**
     * BSS添削後レコードを削除する
     * @param $id
     * @return mixed
     */
    public static function DeleteBSSScore($id){
        return self::where('id', $id)->update([
            'deleted_at' => now(),
        ]);
    }

    public static function UpdateOKANDNGFlag($user_id, $BSS_id, $OK_flag, $NG_flag){
        return self::where('user_id', $user_id)->where('BSS_id', $BSS_id)->update([
            'OK_flag' => $OK_flag,
            'NG_flag' => $NG_flag,
        ]);
    }

}

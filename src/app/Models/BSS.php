<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * BSSテーブルにcategoriesテーブルとachieveテーブルを結合する
     * @return mixed
     */
    public static function GetBSSANDAchieveList(){
        return self::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->get();
    }

    /**
     * BSSテーブルにcategoriesテーブルを結合する
     * @return mixed
     */
    public static function GetBSSList(){
        return self::leftjoin('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note', 'categories.name')
            ->orderby('BSS.id', 'ASC')
            ->get();
    }

    /**
     * カテゴリーで絞ったBSS一覧を取得
     * @param $category_id
     * @return mixed
     */
    public static function GetBSSListSearchCategory($category_id){
        return self::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->where('BSS.category_id', $category_id)->get();
    }

    /**
     * 新規BSSを作成する
     * @param $category_id
     * @param $title
     * @param $level
     * @param $note
     * @return mixed
     */
    public static function CreateBSSRecord($category_id, $title, $level, $note){
        return self::create([
            'category_id' => $category_id,
            'title' => $title,
            'level' => $level,
            'note' => $note,
        ]);
    }

    /**
     * BSSを削除する
     * @param $id
     * @return mixed
     */
    public static function DeleteBSS($id){
        return self::where('id', $id)->update([
            'deleted_at' => now(),
        ]);
    }

    /**
     * 特定のユーザーのBSS一覧を取得する
     * @param $user_id
     * @return mixed
     */
    public static function GetBSSListTargetUser($user_id){
        return self::leftjoin('achieve', function ($join) use($user_id){
            $join->on('achieve.BSS_id', '=', 'BSS.id')
                ->where('achieve.user_id', $user_id);
        })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->orderby('BSS.id', 'ASC')
            ->get();
    }

    /**
     * BSS解釈とステータスを取得
     * @param $user_id
     * @return mixed
     */
    public static function GetBSSDescriptionANDStatus($user_id){
        return self::leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->leftjoin('descriptions', function($join) use ($user_id){
                $join->on('descriptions.BSS_id', '=', 'BSS.id')
                    ->where('user_id', $user_id);
            })
            ->select('BSS.id as id', 'BSS.title', 'descriptions.description', 'descriptions.OK_flag', 'descriptions.NG_flag', 'categories.name')
            ->get();
    }

    /**
     *
     * @param $user_id
     * @param $achieve_id
     * @return mixed
     */
    public static function GetBSSListSearchAchieve($user_id, $achieve_id){
        return self::leftjoin('achieve', function ($join) use($user_id){
            $join->on('achieve.BSS_id', '=', 'BSS.id')
                ->where('achieve.user_id', $user_id);
        })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
            ->orderby('BSS.id', 'ASC')->where('achievement', $achieve_id)->get();
    }

    /**
     * 対象のカラムのみ取得する
     * @param $user_id
     * @param $column_name
     * @return mixed
     */
    public static function GetBSSListSortTargetColumn($user_id, $column_name){
        return self::leftjoin('achieve', function ($join) use($user_id){
            $join->on('achieve.BSS_id', '=', 'BSS.id')
                ->where('achieve.user_id', $user_id);
        })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
            ->orderby($column_name, 'ASC')->get();
    }

    /**
     * 解釈未記入レコードだけ取得する
     * @param $user_id
     * @return mixed
     */
    public static function GetBSSNoDescriptionData($user_id){
        return self::leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->leftjoin('descriptions', function($join) use ($user_id){
                $join->on('descriptions.BSS_id', '=', 'BSS.id')
                    ->where('user_id', $user_id);
            })
            ->select('BSS.id as id', 'BSS.title', 'descriptions.description', 'categories.name')
            ->whereNull('descriptions.description')->get();
    }



}

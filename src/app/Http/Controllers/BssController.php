<?php

namespace App\Http\Controllers;

use App\Models\Achieve;
use App\Models\BSS;
use App\Models\User;
use App\Models\Description;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BssController extends Controller
{
    /**
     * BSS一覧ページを表示する
     * @return View
     */
    public function showBssPage(){
        $user_id = Auth::id();

        $BSS_data = BSS::leftjoin('achieve', function ($join) use($user_id){
            $join->on('achieve.BSS_id', '=', 'BSS.id')
                ->where('achieve.user_id', $user_id);
        })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->orderby('BSS.id', 'ASC')
            ->get();

        return view('bss')
            ->with('BSS_data', $BSS_data);
    }

    /**
     * BSSテストページを表示する
     * @return View
     */
    public function showBssTestPage(){
        return view('bss_test');
    }

    /**
     * BSS解釈記入ページ表示
     * @return View
     */
    public function showBssDescPage(){
        $BSS_data = BSS::leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->leftjoin('descriptions', function($join){
                $join->on('descriptions.BSS_id', '=', 'BSS.id')
                    ->where('user_id', Auth::id());
            })
            ->select('BSS.id as id', 'BSS.title', 'descriptions.description', 'categories.name')
            ->get();


        return view('bss_desc')
            ->with('BSS_data', $BSS_data);

    }

    /**
     * 解釈未記入のレコードのみ表示
     * @return View
     */
    public function showBssDescPageAfterSort(){
        $BSS_data = BSS::leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->leftjoin('descriptions', function($join){
                $join->on('descriptions.BSS_id', '=', 'BSS.id')
                    ->where('user_id', Auth::id());
            })
            ->select('BSS.id as id', 'BSS.title', 'descriptions.description', 'categories.name')
            ->whereNull('descriptions.description')->get();


        return view('bss_desc')
            ->with('BSS_data', $BSS_data);
    }


    /**
     * BSS解釈追加ページ表示
     * @param $id
     * @return View
     */
    public function showAddBSSDescripionPage($id){
        $user_id = Auth::id();
        $desc = null;
        $is_exists = Description::where('user_id', $user_id)->where('BSS_id', $id)->exists();
        if($is_exists){
            $desc = Description::where('user_id', $user_id)->where('BSS_id', $id)->first();
            $is_exists = 1;
        }else{
            $is_exists = 0;
        }
            $BSS = BSS::find($id);

        return view('bss_desc_edit')
            ->with('desc', $desc)
            ->with('is_exists', $is_exists)
            ->with('BSS', $BSS);
    }

    /**
     * BSS解釈を追加する
     * @param Request $request
     * @return View
     */
    public function addBSSDescripion(Request $request){
        $user_id = Auth::id();
        $description = $request->description;
        $BSS_id = $request->BSS_id;
        try {
            if($request->is_exists == 1){
                Description::where('user_id', $user_id)->where('BSS_id', $BSS_id)->update([
                    'description' => $description
                ]);

            }else{
                Description::create([
                    'user_id' => $user_id,
                    'BSS_id' => $BSS_id,
                    'description' => $description
                ]);
            }
        } catch (\Throwable $th) {
            $message = '通信に失敗しました。';

            return self::showBssDescPage();
        }


        return self::showBssDescPage();
    }

    /**
     * BSSの絞り込みを行う
     * メモ：　１：〇のみ　２：△のみ　３：空白
     * @param $id
     * @return View
     */
    public function showBssPageAfterSearch($id){
        $user_id = Auth::id();

        switch ($id){
            case 1:
                $BSS_data = BSS::leftjoin('achieve', function ($join) use($user_id){
                    $join->on('achieve.BSS_id', '=', 'BSS.id')
                        ->where('achieve.user_id', $user_id);
                })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
                    ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
                    ->orderby('BSS.id', 'ASC')->where('achievement', 0)->get();
                break;
            case 2:
                $BSS_data = BSS::leftjoin('achieve', function ($join) use($user_id){
                    $join->on('achieve.BSS_id', '=', 'BSS.id')
                        ->where('achieve.user_id', $user_id);
                })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
                    ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
                    ->orderby('BSS.id', 'ASC')->where('achievement', 1)->get();
                break;
            case 3:
                $BSS_data = BSS::leftjoin('achieve', function ($join) use($user_id){
                    $join->on('achieve.BSS_id', '=', 'BSS.id')
                        ->where('achieve.user_id', $user_id);
                })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
                    ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
                    ->orderby('BSS.id', 'ASC')->where('achievement', 2)->get();
                break;
        }
        return view('bss')
            ->with('BSS_data', $BSS_data);

    }

    /**
     * BSSの並び替えを行う
     * メモ：１：カテゴリー　２：レベル　３：No.
     * @param $id
     * @return View
     */
    public function showBssPageAfterSort($id){
        $user_id = Auth::id();

        switch ($id){
            case 1:
                $BSS_data = BSS::leftjoin('achieve', function ($join) use($user_id){
                    $join->on('achieve.BSS_id', '=', 'BSS.id')
                        ->where('achieve.user_id', $user_id);
                })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
                    ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
                    ->orderby('BSS.category_id', 'ASC')->get();
                break;
            case 2:
                $BSS_data = BSS::leftjoin('achieve', function ($join) use($user_id){
                    $join->on('achieve.BSS_id', '=', 'BSS.id')
                        ->where('achieve.user_id', $user_id);
                })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
                    ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
                    ->orderby('BSS.level', 'ASC')->get();
                break;
            case 3:
                $BSS_data = BSS::leftjoin('achieve', function ($join) use($user_id){
                    $join->on('achieve.BSS_id', '=', 'BSS.id')
                        ->where('achieve.user_id', $user_id);
                })->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
                    ->select('BSS.id as id', 'BSS.title', 'BSS.level','BSS.category_id', 'BSS.note','achieve.achievement', 'categories.name')
                    ->orderby('BSS.id', 'ASC')->get();
                break;
        }
        return view('bss')
            ->with('BSS_data', $BSS_data);
    }

}

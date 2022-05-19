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
    public function addBSSDescripion(Request $request){
        $user_id = Auth::id();
        $description = $request->description;
        $BSS_id = $request->BSS_id;
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

        return self::showBssDescPage();
    }

}

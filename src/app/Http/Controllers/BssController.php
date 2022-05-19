<?php

namespace App\Http\Controllers;

use App\Models\Achieve;
use App\Models\BSS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BssController extends Controller
{
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

    public function showBssTestPage(){
        return view('bss_test');
    }

    public function showBssDescPage(){
        // ここに解釈テーブルをジョインしたい
        $BSS_data = BSS::leftjoin('categories', 'categories.id', '=', 'BSS.category_id')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->get();
        return view('bss_desc')
            ->with('BSS_data', $BSS_data);

    }
}

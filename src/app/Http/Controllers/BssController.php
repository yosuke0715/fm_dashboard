<?php

namespace App\Http\Controllers;

use App\Models\Achieve;
use App\Models\BSS;
use Illuminate\Http\Request;

class BssController extends Controller
{
    public function showBssPage(){
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->get();
        return view('bss')
            ->with('BSS_data', $BSS_data);
    }

    public function showBssTestPage(){
        return view('bss_test');
    }

    public function showBssDescPage(){
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->get();
        return view('bss_desc')
            ->with('BSS_data', $BSS_data);

    }
}

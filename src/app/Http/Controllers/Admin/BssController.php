<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achieve;
use App\Models\BSS;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Utils;

class BssController extends Controller
{
    public function showBssPage(){
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->leftjoin('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->orderby('BSS.id', 'ASC')
            ->get();
        return view('admin.bss')
            ->with('BSS_data', $BSS_data);
    }

    public function showBssTestPage(){
        return view('admin.bss_add');
    }

    public function showBssDescPage(){
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->get();
        return view('admin.bss_desc')
            ->with('BSS_data', $BSS_data);

    }

    public function showAddBSSPage($message = null){
        $categories = Category::get();

        return view('admin.bss_add')
            ->with('categories', $categories)
            ->with('message', $message);
    }

    public function addBSS(Request $request){
        try {
            BSS::create([
                'category_id' => $request->category,
                'title' => $request->title,
                'level' => $request->level,
                'note' => $request->note,
            ]);
            $message = $request->title."を新規追加しました。";
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('flash_message', '更新が失敗しました');
            $message = "更新が失敗しました。";
        }
        return self::showAddBSSPage($message);
    }

    public function showEditPage(){
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->get();
        $categories = Category::get();
        return view('admin.bss_edit')
            ->with('categories', $categories)
            ->with('BSS_data', $BSS_data);
    }

    public function searchBSS($id){
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->where('BSS.category_id', $id)->get();
        $categories = Category::get();

        return view('admin.bss_edit')
            ->with('categories', $categories)
            ->with('BSS_data', $BSS_data);
    }

    public function showEditBSSPage($id){
        $categories = Category::get();
        $BSS = BSS::where('id', $id)->first();

        return view('admin.update_bss')
            ->with('BSS', $BSS)
            ->with('categories', $categories);
    }

    public function updateBSS(Request $request){
        $BSS_id = $request->id;
        $BSSModel = BSS::find($BSS_id);
        $BSSModel->fill($request->all())->save();

        return self::showEditPage();
    }

    public function deleteBSS($id){
        BSS::where('id', $id)->update([
            'deleted_at' => now(),
        ]);

        return self::showEditBSSPage();
    }
}

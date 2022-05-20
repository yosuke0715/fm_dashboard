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
    /**
     * BSS一覧ページを表示
     * @return View
     */
    public function showBssPage(){
        $BSS_data = BSS::leftjoin('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note', 'categories.name')
            ->orderby('BSS.id', 'ASC')
            ->get();
        return view('admin.bss')
            ->with('BSS_data', $BSS_data);
    }

    public function showBssTestPage(){
        return view('admin.bss_add');
    }

    /**
     * BSS解釈一覧ページを表示
     * @return View
     */
    public function showBssDescPage(){
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->get();
        return view('admin.bss_desc')
            ->with('BSS_data', $BSS_data);

    }

    public function showBSSScore($message = null){

        return view('admin.bss_score')
            ->with('message', $message);
    }

    /**
     * BSS進捗確認ページを表示
     * @return View
     */
    public function showBSSProgressPage(){
        $users = User::get();
        $user_array = [];
        $BSS_ids = BSS::whereNull('deleted_at')->select('id')->get();
        foreach($users as $index => $user){
            $user_id = $user->id;
            $achieve_array[$index] = Achieve::where('user_id', $user_id)->select('BSS_id', 'achievement')->get();
            $index_plus = 0;
            foreach ($BSS_ids as $i => $BSS_id){
                if(isset($achieve_array[$index][$index_plus]['BSS_id'])){
                    if ($BSS_id->id == $achieve_array[$index][$index_plus]['BSS_id'] ) {
                        $user_array[$user->name][$i] = $achieve_array[$index][$index_plus]['achievement'];
                        $index_plus++;
                    } else {
                        $user_array[$user->name][$i] = null;
                    }
                }else {
                    $user_array[$user->name][$i] = null;
                }
            }
        }
        $BSS = BSS::whereNull('deleted_at')->get();
        $BSS_array = [];
        foreach ($BSS as $index => $BSS_item){
            $BSS_array[$index]['id'] = $BSS_item->id;
            $BSS_array[$index]['title'] = $BSS_item->title;
            foreach ($users as $user){
                $BSS_array[$index]['user_name'][$user->name] = $user_array[$user->name][$index];
            }
        }
        return view('admin.bss_progress')
        ->with('users', $users)
        ->with('BSS_array', $BSS_array);
    }

    /**
     * BSS項目追加ページを表示
     * @param $message
     * @return View
     */
    public function showAddBSSPage($message = null){
        $categories = Category::get();

        return view('admin.bss_add')
            ->with('categories', $categories)
            ->with('message', $message);
    }

    /**
     * BSSを追加する
     * @param Request $request
     * @return View
     */
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

    /**
     * BSS編集ページを表示
     * @return View
     */
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

    /**
     * BSSカテゴリーで絞る
     * @param $id
     * @return View
     */
    public function searchBSS($id){
//        dd($id);
        $BSS_data = BSS::leftjoin('achieve', 'achieve.BSS_id', '=', 'BSS.id')
            ->join('categories', 'categories.id', '=', 'BSS.category_id')->whereNull('BSS.deleted_at')
            ->select('BSS.id as id', 'BSS.title', 'BSS.level', 'BSS.note','achieve.achievement', 'categories.name')
            ->where('BSS.category_id', $id)->get();
        $categories = Category::get();

        return view('admin.bss_edit')
            ->with('categories', $categories)
            ->with('BSS_data', $BSS_data);
    }

    /**
     * BSS編集ページの表示
     * @param $id
     * @return View
     */
    public function showEditBSSPage($id){
        $categories = Category::get();
        $BSS = BSS::where('id', $id)->first();

        return view('admin.update_bss')
            ->with('BSS', $BSS)
            ->with('categories', $categories);
    }

    /**
     * BSSを編集する
     * @param Request $request
     * @return View
     */
    public function updateBSS(Request $request){
        $BSS_id = $request->id;
        $BSSModel = BSS::find($BSS_id);
        $BSSModel->fill($request->all())->save();

        return self::showEditPage();
    }

    /**
     * BSSを削除する
     * @param $id
     * @return View
     */
    public function deleteBSS($id){
        BSS::where('id', $id)->update([
            'deleted_at' => now(),
        ]);

        return self::showEditBSSPage();
    }
}

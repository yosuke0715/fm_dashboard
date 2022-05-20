<?php

namespace App\Http\Controllers;

use App\Models\Achieve;
use App\Models\BSS;
use App\Models\Score;
use App\Models\User;
use App\Models\Description;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BssController extends Controller
{

    private const BLANK = 1;
    private const MIDDLE = 2;
    private const OK = 3;
    /**
     * BSS一覧ページを表示する
     * @return View
     */
    public function showBssPage(){
        $user_id = Auth::id();

        $BSS_data = BSS::GetBSSListTargetUser($user_id);

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
    public function showBssDescPage($message = null){
        $user_id = Auth::id();
        $BSS_data = BSS::GetBSSDescriptionANDStatus($user_id);

        return view('bss_desc')
            ->with('message', $message)
            ->with('BSS_data', $BSS_data);

    }

    /**
     * 解釈未記入のレコードのみ表示
     * @return View
     */
    public function showBssDescPageAfterSort($message = null){
        $user_id = Auth::id();
        $BSS_data = BSS::GetBSSNoDescriptionData($user_id);


        return view('bss_desc')
            ->with('message', $message)
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
        $name = $request->name;
        $BSS_id = $request->BSS_id;
        try {
            if($request->is_exists == 1){

                // トランザクション開始
                DB::beginTransaction();
                Description::where('user_id', $user_id)->where('BSS_id', $BSS_id)->update([
                    'description' => $description,
                    'NG_flag' => null,
                ]);
                Score::CreateBSSDescription($user_id, $BSS_id, $name, $description);
                DB::commit();
            }else{
                Description::CreateDescription($user_id, $BSS_id, $description);
                Score::CreateBSSDescription($user_id, $BSS_id, $name, $description);
            }
            $message = '追加に成功しました。';
            return self::showBssDescPage($message);
        } catch (\Throwable $th) {
            $message = '通信に失敗しました。';
            DB::rollBack();
            return self::showBssDescPage($message);
        }

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
                $BSS_data = BSS::GetBSSListSearchAchieve($user_id, self::BLANK);
                break;
            case 2:
                $BSS_data = BSS::GetBSSListSearchAchieve($user_id, self::MIDDLE);
                break;
            case 3:
                $BSS_data = BSS::GetBSSListSearchAchieve($user_id, self::OK);
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
                $BSS_data = BSS::GetBSSListSortTargetColumn($user_id, 'BSS.category_id');
                break;
            case 2:
                $BSS_data = BSS::GetBSSListSortTargetColumn($user_id, 'BSS.level');
                break;
            case 3:
                $BSS_data = BSS::GetBSSListSortTargetColumn($user_id, 'BSS.id');
                break;
        }
        return view('bss')
            ->with('BSS_data', $BSS_data);
    }

}

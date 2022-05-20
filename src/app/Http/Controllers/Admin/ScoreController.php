<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Description;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{

    private const TRUE = 1;
    private const FALSE = 0;

    /**
     * 解釈添削ページ表示
     * @param $message
     * @return View
     */
    public function showScorePage($message = null){

        $scores = Score::GetBSSScore();

        return view('admin.bss_score')
        ->with('message', $message)
        ->with('scores', $scores);
    }

    /**
     * 解釈がOKだった時にOKフラグを追加する
     * @param $id
     * @return View
     */
    public function addBSSOKFlag($id){
        $score = Score::find($id);
        $user_id = $score->user_id;
        $BSS_id = $score->BSS_id;

        try {
            DB::beginTransaction();
            Description::UpdateOKANDNGFlag($user_id, $BSS_id, self::TRUE, self::FALSE);

            Score::DeleteBSSScore($id);

            DB::commit();
            $message = "正常に処理を行いました";
            return self::showScorePage($message);
        } catch (\Throwable $th) {
            $message = '通信に失敗しました。';

            DB::rollBack();
            return self::showScorePage($message);
        }
    }

    /**
     * 解釈を再提出状態にする
     * @param $id
     * @return View
     */
    public function addBSSNGFlag($id){
        $score = Score::find($id);
        $user_id = $score->user_id;
        $BSS_id = $score->BSS_id;

        try {
            DB::beginTransaction();
            Description::UpdateOKANDNGFlag($user_id, $BSS_id, self::FALSE, self::TRUE);

            Score::DeleteBSSScore($id);

            DB::commit();
            $message = "正常に処理を行いました";
            return self::showScorePage($message);
        } catch (\Throwable $th) {
            $message = '通信に失敗しました。';
            DB::rollBack();
            return self::showScorePage($message);
        }
    }

}

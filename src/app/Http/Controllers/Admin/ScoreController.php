<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Description;
use App\Models\Score;

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

        $scores = Score::leftjoin('users', 'users.id', '=', 'score.user_id')
            ->select('score.id as id', 'score.user_id', 'score.name as title', 'score.BSS_id', 'score.description', 'users.name')
            ->whereNull('deleted_at')->get();

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
            Description::where('user_id', $user_id)->where('BSS_id', $BSS_id)->update([
                'OK_flag' => self::TRUE,
                'NG_flag' => self::FALSE,
            ]);

            Score::where('id', $id)->update([
                'deleted_at' => now(),
            ]);

            $message = "正常に処理を行いました";
            return self::showScorePage($message);
        } catch (\Throwable $th) {
            $message = '通信に失敗しました。';

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
            Description::where('user_id', $user_id)->where('BSS_id', $BSS_id)->update([
                'OK_flag' => self::FALSE,
                'NG_flag' => self::TRUE,
            ]);

            Score::where('id', $id)->update([
                'deleted_at' => now(),
            ]);

            $message = "正常に処理を行いました";
            return self::showScorePage($message);
        } catch (\Throwable $th) {
            $message = '通信に失敗しました。';

            return self::showScorePage($message);
        }
    }

}

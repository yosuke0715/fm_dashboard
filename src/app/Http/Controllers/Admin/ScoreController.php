<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Description;
use App\Models\Score;

class ScoreController extends Controller
{

    private const TRUE = 1;
    private const FALSE = 1;

    public function showScorePage($message = null){

        $scores = Score::whereNull('deleted_at')->get();

        return view('admin.bss_score')
        ->with('message', $message)
        ->with('scores', $scores);
    }

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

<?php

namespace App\Http\Controllers;

use App\Models\BSS;
use App\Models\Category;
use App\Models\Question;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{

    private const TRUE = 0;
    private const FALSE = 1;
    private const STATUS_DEFAULT = 0;
    private const STATUS_OK = 1;
    private const STATUS_NG = 2;

    /**
     * BSSテストページを表示
     * @param $message
     * @param $is_answered
     * @return View
     */
    public function showBssTestPage($message = null, $is_answered = self::FALSE)
    {

        $today = Carbon::today()->format('Y-m-d');
        $is_answered = Test::whereDate('created_at', $today)->exists()? self::TRUE : self::FALSE;
        $is_question = Question::whereDate('time', $today)->exists();

        if($is_question){
            $question = Question::whereNull('deleted_at')->whereDate('time', $today)->first();
        }else{
            $question = BSS::leftjoin('categories', 'BSS.category_id', '=', 'categories.id')->whereNull('BSS.deleted_at')->inRandomOrder()->first();
        }
        return view('bss_test')
            ->with('question', $question)
            ->with('is_answered', $is_answered)
            ->with('message', $message);
    }

    /**
     * BSSテストの解答をDBに追加
     * @param Request $request
     * @return View
     */
    public function addBSSAnswer(Request $request)
    {
        $user_id = Auth::id();
        $answer = $request->answer;
        $title = $request->title;

        try{
            Test::insert([
                'user_id' => $user_id,
                'answer' => $answer,
                'test_name' => $title,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $is_answered = self::TRUE;

            $message = "解答が正常に送信されました。";
            return self::showBssTestPage($message, $is_answered);

        } catch (\Throwable $th) {

            $message = '通信に失敗しました。';
            return self::showBssTestPage($message);
        }

    }
    /**
     * BSSテストの履歴一覧ページを表示
     * @return View
     */
    public function showBSSTestHistory($message = null)
    {
        $user_id = Auth::id();
        $tests = Test::where('user_id', $user_id)->orderby('created_at', 'DESC')->get();

        return view('bss_history')
            ->with('tests', $tests)
            ->with('message', $message);
    }

    /**
     * BSSテストの再提出一覧ページを表示
     * @return View
     */
    public function showBSSTestResubmit($message = null)
    {
        $user_id = Auth::id();
        $tests = Test::where('user_id', $user_id)->where('status', self::STATUS_NG)->get();

        return view('bss_resubmit')
            ->with('tests', $tests)
            ->with('message', $message);
    }
}

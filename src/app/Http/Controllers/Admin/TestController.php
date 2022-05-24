<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.bss_test')
            ->with('question', $question)
            ->with('is_answered', $is_answered)
            ->with('message', $message);
    }

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

}

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
    private const STATUS_DEFAULT = 0;
    private const STATUS_OK = 1;
    private const STATUS_NG = 2;
    private const STATUS_RESUBMIT = 3;

    /**
     * テスト添削ページを表示
     * @param $message
     * @return View
     */
    public function showBssTestPage($message = null)
    {
        $tests = Test::leftjoin('users', 'tests.user_id', '=', 'users.id')
        ->whereNull('tests.deleted_at')->where(function($query) {
            $query->where('tests.status', self::STATUS_DEFAULT)
                ->orwhere('tests.status', self::STATUS_RESUBMIT);
        })->select('tests.id as id', 'tests.test_name', 'tests.answer', 'tests.status', 'users.name')->get();

        return view('admin.bss_test')
            ->with('tests', $tests)
            ->with('message', $message);
    }

    /**
     * BSSテストのステータスをOKにする
     * @param $id
     * @return View
     */
    public function saveOKStatusBSSTest($id)
    {
        try {
            Test::where('id', $id)->update([
                'status' => self::STATUS_OK,
                'deleted_at' => now()
            ]);

            $message = '正常にOKで登録されました。';
            return self::showBssTestPage($message);
        }catch (\Throwable $th) {

            $message = '通信に失敗しました。';
            return self::showBssTestPage($message);
        }
    }

    /**
     * BSSテストのステータスをNGにする
     * @param $id
     * @return View
     */
    public function saveNGStatusBSSTest($id)
    {
        try {
            Test::where('id', $id)->update([
                'status' => self::STATUS_NG
            ]);
            $message = '正常にNGで登録されました。';
            return self::showBssTestPage($message);
        }catch (\Throwable $th) {

            $message = '通信に失敗しました。';
            return self::showBssTestPage($message);
        }
    }


}

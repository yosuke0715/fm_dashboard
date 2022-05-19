<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class CategoryController extends Controller
{
    /**
     * カテゴリー追加ページを表示
     * @param $message
     * @return View
     */
    public function showAddCategoryPage($message = null){

        return view('admin.add_category')
            ->with('message', $message);
    }

    /**
     * カテゴリーを追加する
     * @param Request $request
     * @return View
     */
    public function addCategory(Request $request){
        try {
            $category = $request->category;
            Category::create([
                'name' => $category
            ]);

            $message = "追加に成功しました。";

            return Self::showAddCategoryPage($message);
        } catch (\Throwable $th) {
            $message = '通信に失敗しました。';

            return self::showAddCategoryPage($message);
        }
    }
}

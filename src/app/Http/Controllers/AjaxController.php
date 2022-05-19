<?php

namespace App\Http\Controllers;

use App\Models\Achieve;
use Illuminate\Http\Request;
use Log;

class AjaxController extends Controller
{
    public function addBSSAchievement($user_id, $BSS_id, $achieve_id){

        try {
            $is_exists = Achieve::where('user_id', $user_id)->where('BSS_id', $BSS_id)->exists();
            Log::debug($achieve_id);

                if($is_exists){
                    Achieve::where('user_id', $user_id)->where('BSS_id', $BSS_id)->update([
                        'achievement' => $achieve_id
                    ]);
                }else{
                    $achieveModel = new Achieve;
                    $achieveModel->user_id = $user_id;
                    $achieveModel->BSS_id = $BSS_id;
                    $achieveModel->achievement = $achieve_id;
                    $achieveModel->created_at = now();
                    $achieveModel->updated_at = now();
                    $achieveModel->save();
                }


            $result = [
                'message' => '成功しました'
            ];
            return response()->json($result);
        } catch (\Throwable $th) {
            $status = 'error';
            $message = '通信に失敗しました。';
            $result = [
                'status' => $status,
                'message' => $message
            ];
            return response()->json($result);
        }
    }
}

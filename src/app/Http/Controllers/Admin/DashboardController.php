<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achieve;
use App\Models\BSS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    const achieve_OK = 2;
    const achieve_Middle = 1;
    const achieve_NG = 0;

    public function showDashboard(){

        $user_progress_array = [];
        $users = User::get();
        $BSS_count = intval(BSS::count());
        foreach ($users as $index => $user){
            $user_progress_array[$index]['user_id'] = $user->id;
            $user_progress_array[$index]['user_name'] = $user->name;
            $OK_count = intval(Achieve::where('user_id', $user->id)->where('achievement', self::achieve_OK)->count());
            $user_progress_array[$index]['OK_count'] = $OK_count;
            $middle_count = intval(Achieve::where('user_id', $user->id)->where('achievement', self::achieve_Middle)->count());
            $user_progress_array[$index]['middle_count'] = $middle_count;
            $total_progress = round(($OK_count + $middle_count*0.5)/$BSS_count*100, 1);
            $user_progress_array[$index]['total_progress'] = $total_progress;
            $blank_count = $BSS_count - $OK_count - $middle_count;
            $user_progress_array[$index]['blank_count'] = $blank_count;
        }
        return view('admin.home')
            ->with('users', $user_progress_array);
    }
}

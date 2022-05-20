<?php

namespace App\Http\Controllers;

use App\Models\Achieve;
use App\Models\BSS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Description;

class DashboardController extends Controller
{

    const achieve_OK = 2;
    const achieve_Middle = 1;
    const achieve_NG = 0;

    public function showDashboard(){

        $user_id = Auth::id();
        $BSS_count = intval(BSS::count());
        $OK_count = intval(Achieve::CountAchievement($user_id, self::achieve_OK));
        $middle_count = intval(Achieve::CountAchievement($user_id, self::achieve_Middle));
        $total_progress = ($OK_count + $middle_count*0.5)/$BSS_count*100;
        $blank_count = $BSS_count - $OK_count - $middle_count;
        $users = User::get();
        $description = Description::where('user_id', $user_id)->count();
        $description_count = round(($description/$BSS_count)*100, 1);

        $user_progress_array = [];
        foreach ($users as $index => $user){
            $user_OK_count = intval(Achieve::CountAchievement($user_id, self::achieve_OK));
            $user_middle_count = intval(Achieve::CountAchievement($user_id, self::achieve_Middle));
            $user_description = Description::where('user_id', $user->id)->count();
            $user_description_count = round(($user_description/$BSS_count)*100, 1);
            $user_progress_array[$index]['user_id'] = $user->id;
            $user_progress_array[$index]['user_name'] = $user->name;
            $user_progress_array[$index]['user_mail'] = $user->email;
            $user_progress_array[$index]['OK_count'] = $user_OK_count;
            $user_progress_array[$index]['total_progress'] = round(($user_OK_count + $user_middle_count*0.5)/$BSS_count*100, 1);
            $user_progress_array[$index]['BSS_count'] = $BSS_count;
            $user_progress_array[$index]['description_count'] = $user_description_count;
            $user_progress_array[$index]['last_login'] = $user->last_login_at;
        }

        $today = new Carbon('today');
        $finish = new Carbon('2022-07-01');
        $date_count = $today->diffInWeekdays($finish);

        return view('home')
            ->with('OK_count', $OK_count)
            ->with('middle_count', $middle_count)
            ->with('blank_count', $blank_count)
            ->with('users', $users)
            ->with('date_count', $date_count)
            ->with('description_count', $description_count)
            ->with('BSS_count', $BSS_count)
            ->with('user_progress_array', $user_progress_array)
            ->with('total_progress', $total_progress);
    }
}

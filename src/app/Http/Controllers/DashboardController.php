<?php

namespace App\Http\Controllers;

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

        $user_id = Auth::id();
        $BSS_count = intval(BSS::count());
        $OK_count = intval(Achieve::where('user_id', $user_id)->where('achievement', self::achieve_OK)->count());
        $middle_count = intval(Achieve::where('user_id', $user_id)->where('achievement', self::achieve_Middle)->count());
        $total_progress = ($OK_count + $middle_count*0.5)/$BSS_count*100;
        $blank_count = $BSS_count - $OK_count - $middle_count;
        $users = User::get();

        return view('home')
            ->with('OK_count', $OK_count)
            ->with('middle_count', $middle_count)
            ->with('blank_count', $blank_count)
            ->with('users', $users)
            ->with('BSS_count', $BSS_count)
            ->with('total_progress', $total_progress);
    }
}

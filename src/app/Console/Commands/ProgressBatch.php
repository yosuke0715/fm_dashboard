<?php

namespace App\Console\Commands;

use App\Models\Achieve;
use App\Models\BSS;
use App\Models\User;
use Illuminate\Console\Command;

class ProgressBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'progress:progressBatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '隔週の進捗調査バッチ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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
    }
}

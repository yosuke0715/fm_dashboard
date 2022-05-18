<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("個人の達成状況登録を開始します...");

        $memberSplFileObject = new \SplFileObject(__DIR__ . '/data/progress.csv');
        $memberSplFileObject->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        foreach ($memberSplFileObject as $key => $row) {
            if ($key === 0) {
                continue;
            }
            if(trim($row[3])=="")
            {
                $achieve = 0;
            }elseif (trim($row[3])=="△"){
                $achieve = 1;
            }elseif (trim($row[3])=="〇"){
                $achieve = 2;
            }
            \DB::table('achieve')->insert([
                'user_id' => 1,
                'BSS_id' => trim($row[0]),
                'achievement' => $achieve,
            ]);
        }
    }
}

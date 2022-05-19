<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("解釈の作成を開始します...");

        $memberSplFileObject = new \SplFileObject(__DIR__ . '/data/description.csv');
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

            if(trim($row[6]) != null) {
                \DB::table('descriptions')->insert([
                    'user_id' => 1,
                    'BSS_id' => trim($row[0]),
                    'description' => trim($row[6]),
                ]);
            }
        }
    }
}

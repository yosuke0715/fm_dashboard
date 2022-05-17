<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BSSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("BSSの作成を開始します...");

        $memberSplFileObject = new \SplFileObject(__DIR__ . '/data/bss.csv');
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

            \DB::table('BSS')->insert([
                'id' => trim($row[0]),
                'category_id' => 1,
                'title' => trim($row[4]),
                'level' => trim($row[2]),
                'note' => trim($row[5]),
            ]);
        }
    }
}

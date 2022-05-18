<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            [
                'name' => 'HTML',
            ],
            [
                'name' => 'CSS',
            ],
            [
                'name' => 'JavaScript',
            ],
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'Laravel',
            ],
            [
                'name' => '全般',
            ],
            [
                'name' => 'フロントエンド',
            ],
            [
                'name' => 'バックエンド',
            ]
        ]);
    }
}

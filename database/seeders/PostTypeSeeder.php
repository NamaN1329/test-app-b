<?php

namespace Database\Seeders;

use App\Models\PostType;
use Illuminate\Database\Seeder;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postTypes = [
            [
                "name" => "CHAR MINAR",
                "schedule_time" => "04:00:00",
            ],
            [
                "name" => "DISAWER",
                "schedule_time" => "05:00:00",
            ],
            [
                "name" => "FARIDABAD",
                "schedule_time" => "06:00:00",
            ],
            [
                "name" => "GAZIYABAD",
                "schedule_time" => "08:00:00",
            ],
            [
                "name" => "SHRI HARI",
                "schedule_time" => "11:00:00",
            ],
            [
                "name" => "GALI",
                "schedule_time" => "11:45:00",
            ],
            [
                "name" => "PESHAWER",
                "schedule_time" => "15:00:00",
            ],
            [
                "name" => "HINDUSTAN",
                "schedule_time" => "16:45:00",
            ],
            [
                "name" => "DEEPMALA",
                "schedule_time" => "17:45:00",
            ],
            [
                "name" => "RAJKOT",
                "schedule_time" => "19:00:00",
            ],
        ];
        foreach ($postTypes as $postType) {
            PostType::create($postType);
        }
    }
}

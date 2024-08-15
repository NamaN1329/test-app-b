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
                "schedule_time" => "05:10:00",
            ],
            [
                "name" => "FARIDABAD",
                "schedule_time" => "18:05:00",
            ],
            [
                "name" => "GAZIYABAD",
                "schedule_time" => "20:15:00",
            ],
            [
                "name" => "UK SUPPER",
                "schedule_time" => "20:30:00",
            ],
            [
                "name" => "UK GOLD",
                "schedule_time" => "22:30:00",
            ],
            [
                "name" => "GALI",
                "schedule_time" => "23:00:00",
            ],
        ];
        foreach ($postTypes as $postType) {
            PostType::create($postType);
        }
    }
}

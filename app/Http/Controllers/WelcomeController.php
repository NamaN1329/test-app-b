<?php

namespace App\Http\Controllers;

use App\Models\PostType;
use App\Models\Winner;
use Illuminate\Support\Facades\Date;

class WelcomeController extends Controller
{
    public function index()
    {
        $postTypes = PostType::all();
        $winners = Winner::whereDate("date", Date::today())->with("postType")->get();

        $startDate = Date::now()->startOfMonth();
        $endDate = Date::now()->endOfMonth();

        $endDay = $endDate->format("d");
        $calenders = [];
        for ($i = 1; $i <= $endDay; $i++) {
            $date = $startDate;

            foreach ($postTypes as $postType) {
                $winner = Winner::whereDate("date", $date)->where("post_type", $postType->id)->first();
                if ($winner?->count() > 0) {
                    $calenders[$date->format('d')][$postType->id] = $winner->number;
                } else {
                    $calenders[$date->format('d')][$postType->id] = " -- ";
                }
            }

            $date = $date->addDay();
        }
        
        return view("welcome", compact("winners", "postTypes", "calenders"));
    }
}

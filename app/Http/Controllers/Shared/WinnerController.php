<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        $winners = Winner::orderBy("id","desc")->with("postType")->get();
        return view("shared/winner", compact("winners"));
    }
}

<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\WinnerStoreRequest;
use App\Models\Winner;
use App\Models\PostType;
use Illuminate\Support\Facades\Auth;

class WinnerController extends Controller
{
    public function index()
    {
        $postTypes = PostType::get();
        $winners = Winner::orderBy("id", "desc")->with("postType")->get();
        return view("shared/winner", compact("winners", "postTypes"));
    }

    public function store(WinnerStoreRequest $request)
    {
        $isExists = Winner::where(["post_type" => $request->post_type, "date" => $request->date])->exists();
        
        if (!$isExists) {
            $winner = new Winner();
            $winner->fill([
                "post_type" => $request->post_type,
                "date" => $request->date,
                "number" => $request->number,
                "is_mannual" => true,
                "created_by" => Auth::user()->id
            ])->save();

            return redirect()->back()->with("success", "Winner Store Successfully!");
        } else {
            return redirect()->back()->withErrors(["error" => "Winner already declared!"]);
        }
    }
}

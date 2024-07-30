<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\PostStoreRequest;
use App\Models\Post;
use App\Models\PostType;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 1) {
            $posts = Post::orderBy("created_at", "desc")->get();
        } else {
            $posts = Auth::user()->posts;
        }
        $postTypes = PostType::get();
        return view("shared/post", compact(["posts", "postTypes"]));
    }

    public function show(PostType $postType)
    {
        $posts = $postType->posts()->orderBy("number", "desc")->get();
        return response()->json(["data" => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $post = new Post();

        $post->fill($request->validated());
        $post->fill(["created_by" => Auth::user()->id]);

        $post->save();

        return redirect()->back()->with("success", "Post added succesfully!");
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        $post->fill($request->validated());
        $post->fill(["created_by" => Auth::user()->id]);
        $post->save();

        return redirect()->back()->with("success", "Post updated succesfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(["success" => "User deleted successfully!"]);
    }
}

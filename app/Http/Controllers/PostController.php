<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function migrate()
    {
        Post::factory()->count(5)->create();
        return response()->json([
            "message" => "success",
        ]);
    }

    public function create(CreatePostRequest $request)
    {
        $validatedData = $request->validated();

        $post = new Post;
        $post->fill($validatedData);
        $post->save();

        return response()->json([
            "message" => "success",
        ]);
    }

    public function list()
    {
        $posts = Post::all();
        // dd($posts);
        info($posts);
        return response()->json([
            "message" => "success",
            "data" => $posts
        ]);
    }

    public function update()
    {
    }
};

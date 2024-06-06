<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\DetailPostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function migrate()
    {
        Post::factory()->count(5)->create();

        return response()->json([
            "message" => "success",
        ]);
    }

    public function index()
    {
        $posts = Post::with(['user:id,name'])->get();

        return response()->json([
            "message" => "success",
            "data" => $posts
        ]);
    }

    public function show(Post $post)
    {
        return response()->json([
            'data' => $post
        ]);
    }

    public function store(CreatePostRequest $request)
    {
        $validatedData = $request->validated();

        $post = new Post;
        $post->fill($validatedData);
        $post->save();

        return response()->json([
            "message" => "create success",
        ]);
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => "update successfully"
        ]);
    }

    public function destroy(Post $post)
    {
        Post::where('id', $post->id)->delete();
        return response()->json([
                'message' => "delete successfully"
            ]);
    }
};

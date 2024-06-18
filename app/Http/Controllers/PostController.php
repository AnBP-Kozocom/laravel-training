<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }
    /**
     * Migration data into the database
     */
    public function migrate()
    {
        Post::factory()->count(5)->create();

        return response()->json([
            "message" => "success",
        ]);
    }

    /**
     * Show list posts 
     * Show list post 
     */
    public function index()
    {
        $data = $this->postService->index();
        return response()->json([
            "message" => "success",
            "data" =>  PostResource::collection($data)
        ]);
    }


    /**
     * Show information of a post 
     */
    public function show(Post $post)
    {


        $res = $post->load(['user:id,name'])->where();

        return response()->json([
            "message" => "success",
            "data" => new PostResource($res)
        ]);
    }


    /**
     * Create a new post
     */
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

    /**
     * Update post information
     */
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

    /**
     * Delete a post
     */
    public function destroy(Post $post)
    {
        Post::where('id', $post->id)->delete();
        return response()->json([
            'message' => "delete successfully"
        ]);
    }
};

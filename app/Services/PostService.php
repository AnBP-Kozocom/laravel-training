<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;

class PostService
{

  public function __construct(private PostRepository $postRepo)
  {
  }

  public function index()
  {
    return $this->postRepo->index();
    // return Post::with(['user:id,name'])->get();
  }
}

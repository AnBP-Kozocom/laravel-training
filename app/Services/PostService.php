<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;

class PostService
{

  public function __construct(private PostRepositoryInterface $postRepo)
  {
  }

  public function index()
  {
    $relation = ['user:id,name'];
    return $this->postRepo->findWithByRelation($relation);
  }
}

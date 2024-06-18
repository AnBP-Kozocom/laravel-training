<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PostRepository
{

  public function __construct(private Post $model)
  {
  }

  public function getAllBuilder($column = ['*']): Builder
  {
    return $this->model->query()->select($column)->whereDate('created_at', now());
  }


  public function index()
  {
    return $this->model->all();
  }

  public function getWith( $relation = ['*'] )
  {
    return $this->model->all();
  }




  public function GetByID($id)
  {
    return Post::findOrFail($id);
  }

  // public function getAllById()
  // {
  //   return $this->getAllBuilder()->whereCreatedAt(213)->all();
  // }

  // public function getAllByTitle()
  // {
  //   return $this->getAllBuilder()->whereUserId(213)->all();
  // }
}

<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PostRepository implements PostRepositoryInterface
{
	public function __construct(private Post  $model)
	{
	}

	public function all()
	{
		return $this->model->all();
	}

	public function findWithByRelation(array $relation)
	{
		return  $this->model->with($relation)->get();
	}

	public function findById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function create(array $data)
	{
		return $this->model->create($data);
	}

	public function update(array $data, $id)
	{
		$post = $this->model->findOrFail($id);
		$post->update($post);
	}

	public function delete($id)
	{
		$post = $this->model->findOrFail($id);
		$post->delete($post);
	}
}

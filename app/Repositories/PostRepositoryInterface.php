<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
  public function all();
  public function insert(array $data);
  public function update( array $data, $id);
  public function delete($id);
  public function findById($id);
  public function findWithByRelation(array $relation);
}

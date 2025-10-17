<?php
namespace App\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{

    public function __construct(protected Model $model)
    {
            
    }


    public function all($columns = ['*'])
    {
    return $this->model->get($columns);
    }


    public function find($id)
    {
    return $this->model->findOrFail($id);
    }


    public function create(array $data)
    {
    return $this->model->create($data);
    }


    public function update(Model $model, array $data)
    {
    $model->update($data);
    return $model;
    }


    public function delete(Model $model)
    {
    return $model->delete();
    }


    public function paginate($perPage = 15)
    {
    return $this->model->paginate($perPage);
    }
}
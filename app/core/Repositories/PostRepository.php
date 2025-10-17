<?php
namespace App\Core\Repositories;

use App\Core\Repositories\Interfaces\IPostRepository;
use App\Models\Post;

class PostRepository extends BaseRepository implements IPostRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getPosts()
    {
        return $this->model->all();
    }

    public function getPost($id)
    {
        return $this->model->find($id);
    }

    


}
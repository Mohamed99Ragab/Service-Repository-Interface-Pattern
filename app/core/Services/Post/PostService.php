<?php

namespace App\Core\Services\Post;

use App\Core\Contracts\IPostService;
use App\Core\Repositories\Interfaces\IPostRepository;

class PostService implements IPostService
{
    public function __construct(protected IPostRepository $postRepository)
    {

    }

    public function getPosts()
    {
        return $this->postRepository->all();
    }

    public function getPost($id)
    {
        return $this->postRepository->find($id);
    }
}
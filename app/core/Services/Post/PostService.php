<?php

namespace App\Core\Services\Post;

use App\Core\Contracts\IPostService;
use App\Core\Repositories\PostRepository;

class PostService implements IPostService
{
    public function __construct(protected PostRepository $postRepository)
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
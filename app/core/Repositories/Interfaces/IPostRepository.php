<?php

namespace App\Core\Repositories\Interfaces;

interface IPostRepository {

    public function getPosts();
    public function getPost($id);
}
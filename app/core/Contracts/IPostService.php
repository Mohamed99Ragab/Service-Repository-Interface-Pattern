<?php

namespace App\Core\Contracts;

interface IPostService
{
    public function getPosts();
    public function getPost($id);
}
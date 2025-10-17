<?php

namespace App\Http\Controllers\Web;

use App\Core\Contracts\IPostService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(protected IPostService $postService)
    {

    }
    public function index()
    {
        return $this->postService->getPosts();
        
    }


    public function getPost($id)
    {
        return $this->postService->getPost($id);
    }
}

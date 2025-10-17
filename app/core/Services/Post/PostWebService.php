<?php

namespace App\Core\Services\Post;

class PostWebService extends PostService{


    public function getPosts() {

       $posts = parent::getPosts();
        
       return view('posts.index', compact('posts'));
    }

    public function getPost($id) {

        $post = parent::getPost($id);
        
        return view('posts.show', compact('post'));
    }

}
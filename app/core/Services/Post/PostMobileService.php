<?php 

namespace App\Core\Services\Post;


class PostMobileService extends PostService {

    public function getPosts() {

       $posts = parent::getPosts();
        
       return response()->json([
            'data' => $posts,
            'message' => 'Success',
            ]);
    }

    public function getPost($id) {

        $post = parent::getPost($id);
        
        return response()->json([
            'data' => $post,
            'message' => 'Success',
        ]);
    }


}
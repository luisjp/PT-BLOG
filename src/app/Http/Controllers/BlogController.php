<?php

namespace App\Http\Controllers;

use App\Blog\Infrastructure\Repository\PostRepository;
use App\Blog\Infrastructure\Repository\PostExternalRepository;
use App\Blog\Infrastructure\Repository\UserRepository;

use  App\Blog\Application\Posts\PostsEloquent;
use  App\Blog\Application\Posts\PostsExternal;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BlogController extends Controller
{

    private $postRepository;
    private $postExternalRepository;
    private $userRepository;

    private $postExecute;

    public function __construct(){
        //$this->postRepository = new PostRepository();
        //$this->postExecute = new PostsEloquent($this->postRepository);

        $this->userRepository = new UserRepository();

        $this->postExternalRepository = new PostExternalRepository();
        $this->postExecute = new PostsExternal($this->postExternalRepository);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = $this->postExecute->findAllPosts();
        return response()->json($posts);
    }


    public function getPostById($id) {
        $post = $this->postExecute->findPost($id);
        return response()->json($post);
    }


    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request) {
        $post = $this->postExecute->createPost(
            $request->input('title'),
            $request->input('body')
       );
       return response()->json($post);
    }
}

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
    * @OA\Get(
    *     path="/api/blog/posts",
    *     summary="Show all posts",
    *     description="Show all posts from jsonplaceholder throught our api",
    *     tags={"Posts"},
    *     @OA\Response(
    *         response=200,
    *         description="Shows the entire list of posts in json format."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
    public function index() {
        $posts = $this->postExecute->findAllPosts();
        return response()->json($posts);
    }

    /**
    * @OA\Get(
    *     path="/api/blog/posts/{user_id}",
    *     summary="Show posts by id",
    *     description="Show post by id from jsonplaceholder throught our api",
    *     tags={"Posts"},
    *     @OA\Parameter(
     *         description="ID of pet to fetch",
     *         in="path",
     *         name="user_id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         )
     *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Shows post in json format."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="An error has occurred."
    *     )
    * )
    */
    public function getPostById($id) {
        $post = $this->postExecute->findPost($id);
        return response()->json($post);
    }


    /**
    * @OA\Post(
    *     path="/api/blog/posts/",
    *     summary="Show posts by id",
    *     description="Show post by id from jsonplaceholder throught our api",
    *     tags={"Posts"},
    *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  required={"title","body"},
 *                  @OA\Property(
 *                      property="title",
 *                      type="string",
 *                      description="title"
 *                  ),
 *                  @OA\Property(
 *                      property="body",
 *                      type="string",
 *                      description="body"
 *                  ),
 *             )
 *         )
 *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Post created",
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *     )
    * )
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

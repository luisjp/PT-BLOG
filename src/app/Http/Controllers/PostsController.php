<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog\Domain\Model\Post;
use App\Blog\Infrastructure\Repository\PostRepository;
use App\Blog\Infrastructure\Repository\PostExternalRepository;
use App\Blog\Infrastructure\Repository\UserRepository;

use  App\Blog\Application\Posts\PostsEloquent;
use  App\Blog\Application\Posts\PostsExternal;

class PostsController extends Controller
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
    public function index()
    {
        $posts = $this->postExecute->findAllPosts();
        return view('blog.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'body' => 'required']);
        
        // Funciona con ORM eloquent
        $posts = $this->postExecute->createPost(
             $request->input('title'),
             $request->input('body')
        );
        
        return redirect('/blog')->with('message', 'Your post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $postById = $this->postExecute->findPost($id);
        return view('blog.show')->with('post', $postById);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

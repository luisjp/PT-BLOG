<?php

namespace App\Blog\Infrastructure\JsonDataSource;

use App\Blog\Infrastructure\Tools\JsonToObject;
use Illuminate\Support\Facades\Http;
use App\Blog\Domain\Model\Post;


/**
 * Class PostDataExternal
 * 
 * Class where so-called crud is made 
 */
class PostDataExternal{

    protected $url;

    function __construct() {
        $this->url = env('DATA_JSON_BASE');
    }

    /**
     *  function allPost
     * 
     * method that returns all posts
     */
    public function allPost(){
        $query = '/posts';
        $response = Http::get($this->url . $query);
        if(!$response->successful()){
            return null;
        }

        return JsonToObject::parseArray($response->body());
    }   

    /**
     * function findPost
     * 
     * @param string $id
     * 
     * Method that returns the post by id
     */
    public function findPost($id){
        $query = '/posts/' . $id;
        $response = Http::get($this->url . $query);
        if(!$response->successful()){
            return null;
        }

        return JsonToObject::parse($response->body());
    } 

    /**
     * function createPost
     * 
     * @param Post $post
     * 
     * Method that makes the call directly to the url of the posts data stream
     * 
     */
    public function createPost(Post $post){
        $query = '/posts';
        
        $response = Http::post($this->url . $query, $post->getMapValue());
        
        if(!$response->successful()){
            return null;
        }

        return JsonToObject::parse($response->body());
    }
}
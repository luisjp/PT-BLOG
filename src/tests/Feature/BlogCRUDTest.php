<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Blog\Infrastructure\Eloquent\Post;
use App\Blog\Infrastructure\JsonDataSource\PostDataExternal;
use App\Blog\Infrastructure\Tools\JsonToObject;
use App\Blog\Infrastructure\Translator\PostTranslator;
use App\Blog\Domain\Model\Post as PostModel;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BlogCRUDTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function a_post_created(){
        $this->withoutExceptionHandling();

        $response = $this->post('/blog', [
            'title' => 'Hello World',
            'body' => 'test body',
            'user_id' => 1
        ]);

        $testArray = Post::where('body', 'test body')->get('id')->toArray();
        
        $expectedCount = 1;
  
        $this->assertCount(
            $expectedCount,
            $testArray, ''
        );

        Post::where('body', 'test body')->delete();
    }

    /**
     * @test
     */
    public function a_find_all_posts() {
        
        $this->withoutExceptionHandling();

        factory(Post::class, 3)->create();

        $response = $this->get('/blog');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function call_service_get_posts() {
        $this->withoutExceptionHandling();
        
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
        $this->assertTrue($response->successful());

        $bodyJson = JsonToObject::parse($response->body()); 
        $post = PostTranslator::externalToModel($bodyJson);
        
        $this->assertEquals($post->title, "sunt aut facere repellat provident occaecati excepturi optio reprehenderit");

    }

     /**
     * @test
     */
    public function call_service_post_create_posts() {
        $this->withoutExceptionHandling();
        $post = new PostModel(0, 'titletest', 'bodyTest', '2022-07-22', 1);
        $response = Http::post('https://jsonplaceholder.typicode.com/posts', $post->getMapValue());
        $this->assertTrue($response->successful());
        $step1 = JsonToObject::parse($response->body()); 
        
        $responseObj = PostTranslator::externalToModel($step1);
        
    }

    /**
     * @test
     */
    public function call_service_get_all_posts() {
        $this->withoutExceptionHandling();
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $this->assertTrue($response->successful());

        $step1 = JsonToObject::parseArray($response->body()); 
        $listPosts = [];

        foreach ($step1 as $post) {
            $listPosts[] = PostTranslator::externalToModel($post);
        }
    }
}

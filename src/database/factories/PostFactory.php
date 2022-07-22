<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Blog\Infrastructure\Eloquent\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostFactory extends Factory
{
    use \App\Blog\Infrastructure\Eloquent\Post;
    
    protected $model = \App\Blog\Infrastructure\Eloquent\Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'body' => $this->faker->paragraph,
            'updated_at' => now(),
            'user_id' => 1,
        ];
    }
}

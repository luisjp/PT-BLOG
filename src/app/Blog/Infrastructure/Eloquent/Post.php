<?php

namespace App\Blog\Infrastructure\Eloquent;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];

    protected $guarded = [];

    protected static function newFactory()
    {
        return new PostFactory();
    }	

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function createPost(
        string $title,
        string $body = null
    ){
        return self::create([
            'title' => $title,
            'body' => $body,
            'user_id' => 1 //auth()->user()->id
        ]);
    }

    public function findPost(
        int $id
    ){
        return self::where('id', $id)->first();
    }

    public function allPost(){
        return self::orderBy('updated_at', 'DESC')->get();
    }
}

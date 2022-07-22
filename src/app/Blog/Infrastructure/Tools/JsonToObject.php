<?php

namespace App\Blog\Infrastructure\Tools; 

class JsonToObject {

    static function parse($body){
        return self::parseObject($body);
    }

    static function parseArray($body){
        return self::parseArrayOfObjects($body);
    }

    static function parseObject($post): object{
        return json_decode($post);
    }

    static function parseArrayOfObjects($body): array {
        $result = array();
        $bodyParsed = json_decode($body);
        foreach ($bodyParsed as $post ) { 
            $result[] = self::parseObject(json_encode($post));
        }
        return $result;
    }
}

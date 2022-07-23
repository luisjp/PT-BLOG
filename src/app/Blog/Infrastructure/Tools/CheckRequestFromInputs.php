<?php

namespace App\Blog\Infrastructure\Tools; 


class CheckRequestFromInputs {
    static function parseString(string $input){
        if(!isset($input)){
            return '';
        }
        return $input;
    }
}
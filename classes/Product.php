<?php

class Product extends Service {

    public static function all(){
        return [
            ['name' => 'Phone', 'price'=>500],
            ['name' => 'Keyboard', 'price'=>50],
            ['name' => 'Mouse', 'price'=>100],
        ];
    }
}
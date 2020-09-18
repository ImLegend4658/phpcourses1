<?php

class Service{
    public $available;
    public $taxRate = 0;

    //constructor
    public function __construct(){
        $this->available = true;

    }

    //Desconstructor
    public function __destruct()
    {
//        echo "This class '". __CLASS__."' was destructoed";
    }

    public static function all(){
        return [
            ['name' => 'Consultation', 'price'=>500, 'Days'=>['Sun','Mon']],
            ['name' => 'Traning', 'price'=>200, 'Days'=>['Tues','Wed']],
            ['name' => 'Design', 'price'=>100, 'Days'=>['Thu','Fri']],
        ];
    }

    public function price($price){
        if($this->taxRate > 0){
            return $price + ($price * $this->taxRate);
        }
        return $price;
    }

}
<?php 
class Car{
    public $brand;
    public $model;
    public $speed = 0;

    public function drive(){
        return "\n\ncar is {$this->brand}, {$this->model}, go is {$this->speed} kms \n\n";
    }
};

$myCar = new Car();
$myCar->brand = "Tayota";
$myCar->model = "carolla";
$myCar->speed = "120";

echo $myCar->drive();

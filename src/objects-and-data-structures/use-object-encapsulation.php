<?php

//Use object encapsulation
//Bad
class Car
{
    public $price = 10000;
}

$car = new Car();
$car->price -= 1000;

//Good
class CarGood
{
    private $price;

    public function __construct(int $price = 10000)
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function discount(int $discountPrice = 0): void
    {
        $this->price - $discountPrice;
    }
}

$car = new CarGood();
//Discount
$car->discount(1000);
//Get car's price
$price = $car->getPrice();

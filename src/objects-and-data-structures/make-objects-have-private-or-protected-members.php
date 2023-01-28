<?php

//Make objects have private or protected memebers
//Bad
class Bicycle
{
    public $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }
}

$bicycle = new Bicycle('red');
echo 'Color is ' . $bicycle->color;

//Good
class BicycleGood
{
    private $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function getColor(): int
    {
        return $this->color;
    }
}

$bicycle = new BicycleGood('black');
echo 'Color is ' . $bicycle->getColor();

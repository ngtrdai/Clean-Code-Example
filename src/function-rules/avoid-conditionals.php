<?php

// Avoid conditionals
// Bad
class Book
{
    private $type;
    private $price;
    public const FICTION = 'fiction';
    public const NON_FICTION = 'non-fiction';

    public function __construct($type, $price)
    {
        $this->type = $type;
        $this->price = $price;
    }

    public function getPrice()
    {
        switch ($this->type) {
            case self::FICTION:
                return $this->price * 0.8;
            case self::NON_FICTION:
                return $this->price * 0.9;
            default:
                return $this->price;
        }
    }
}

// Good
interface BookInterface
{
    public function getPrice();
}

class FictionBook implements BookInterface
{
    private $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price * 0.8;
    }
}

class NonFictionBook implements BookInterface
{
    private $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price * 0.9;
    }
}

class OtherBook implements BookInterface
{
    private $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

$book = new FictionBook(100);
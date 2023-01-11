<?php

// Don't use the singleton pattern
// Bad
class Coin
{
    private const ADD_MORE_COIN = 10;
    private $coin;
    private static $instance;

    private function __construct()
    {
        $this->coin = 0;
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function addCoin()
    {
        $this->coin += self::ADD_MORE_COIN;
    }

    public function getCoin()
    {
        return $this->coin;
    }
}

$coin = Coin::getInstance();
$coin->addCoin();
$coin->addCoin();
$coin->addCoin();

echo $coin->getCoin();

// Good
class CoinGood
{
    private const ADD_MORE_COIN = 10;
    private $coin;

    public function __construct()
    {
        $this->coin = 0;
    }

    public function addCoin()
    {
        $this->coin += self::ADD_MORE_COIN;
    }

    public function getCoin()
    {
        return $this->coin;
    }
}


<?php

// Do not use a variable name that is the same as the name of a class.
class Account
{
    public function __construct()
    {
    }
}

$account = new Account();

// Example for meaningful
$accountInfo = new Account();
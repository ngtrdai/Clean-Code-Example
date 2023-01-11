<?php

// Function arguments - 2 or fewer ideal
class User
{
    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
}

// Bad
function createUserMoreArguments($username, $firstname, $lastname, $email, $password)
{
    // ...
}

// Good
function createUser(User $user)
{
    // ...
}

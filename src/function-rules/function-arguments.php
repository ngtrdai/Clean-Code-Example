<?php

class User
{
    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    // Function names should say what they do
    // Bad
    public function handle()
    {
        // ...
    }

    // Good
    public function saveInfo()
    {
        // ...
    }
}

// Function arguments - 2 or fewer ideally
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

// Function arguments - boolean arguments are a code smell
// Bad
function createMember(User $user, $isAdmin)
{
    if ($isAdmin) {
        // ...
    } else {
        // ...
    }
}

// Good
function createStaff(User $user)
{
    // ...
}

function createAdmin(User $user)
{
    // ...
}
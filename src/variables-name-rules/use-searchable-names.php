<?php

class User
{
    const TYPE_ADMIN = 1;
}

// Example for variable names not searchable
if ($user->isAdmin == 1) {
    // ...
}

// Example for variable names searchable
if ($user->type == User::TYPE_ADMIN) {
    // ...
}

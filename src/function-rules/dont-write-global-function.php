<?php

// Don't write to global functions
// Bad
function dd($var)
{
    var_dump($var);
    die();
}

// Good
class Dumper
{
    public static function dump($var)
    {
        // ...
        var_dump($var);
    }
}

Dumper::dump([
    'foo' => 'bar',
]);



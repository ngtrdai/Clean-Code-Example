# **TOPIC: Clean Code and Effective Unit Testing**

# **Clean Code**
## **What is clean code?**
### Common code smells?
### Criteria and principles clean code?
## **Why should we clean code?**
### Why is it important?
### Why should we care?
## **How to clean code?**
### Variables - Name rules
1. Use meaningful and pronounceable names

```php
$moment = new DateTime();
// Example for variable names not meaningful
$ymdstr = $moment->format('y-m-d');
list($y, $m, $d) = explode('-', $ymdstr);
$timestamp = mktime(0, 0, 0, $m, $d, $y);

// Example for variable names meaningful
$today = $moment->format('y-m-d');
list($year, $month, $day) = explode('-', $today);
$timestamp = mktime(0, 0, 0, $month, $day, $year);
```
2. Avoid disinformation

```Programmers must avoid leaving false clues that obscure the meaning of code. We should avoid words whose entrenched meanings vary from our intended meaning```

```php
// Do not refer to a grouping of accounts as an accountList unless it’s actually a List.
$accountList = []; 
// Example for meaningful
$accounts = [];
$acoountGroup = [];
```
3. Do not use a variable name that is the same as the name of a class
```php
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
```
4. Use searchable names
```php
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
```
5. Avoid mental mapping

```Avoid mental mapping. For example, the names i, j, and k are okay as loop counters, but be careful when they are used as variable names.```
```php
// Example for mental mapping
for ($i = 0; $i < 10; $i++) {
    // ...
}
// Example for meaningful
for ($index = 0; $index < 10; $index++) {
    // ...
}
```
### Function rules
1. Function argument - 2 or fewer ideally

`Limiting the amount of function parameters is incredibly important because it makes testing your function easier. Having more than three leads to a combinatorial explosion where you have to test tons of different cases with each separate argument.`

`Zero arguments is the ideal case. One or two arguments is ok, and three should be avoided. Anything more than that should be consolidated. Usually, if you have more than two arguments then your function is trying to do too much. In cases where it's not, most of the time a higher-level object will suffice as an argument.`

```php
<?php

// Function arguments - 2 or fewer ideally
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
```

2. Function names should say what they do
```php
public function handle()
{
    // ...
}

// Good
public function saveInfo()
{
    // ...
}
```

3. Functions should only be one level of abstraction
```php
<?php

// One level of abstraction per function
// Bad
function parseBetterPHP(string $content)
{
    $regexes = [
        '/[a-zA-Z]+/'
    ];

    $statements = explode(' ', $content);
    $tokens = [];

    foreach($statements as $statement) {
        foreach ($regexes as $regex) {
            if (preg_match($regex, $statement, $matches)) {
                $tokens[] = [
                    'type' => gettype($matches[0]),
                    'value' => $matches[0],
                ];
            }
        }
    }

    $ast = [];
    foreach ($tokens as $token) {
        switch ($token['type']) {
            case 'string':
                $ast[] = [
                    'type' => 'String',
                    'value' => $token['value'],
                ];
                break;
            case 'integer':
                $ast[] = [
                    'type' => 'Integer',
                    'value' => $token['value'],
                ];
                break;
        }
    }

    foreach ($ast as $node) {
        switch ($node['type']) {
            case 'String':
                echo $node['value'];
                break;
            case 'Integer':
                echo $node['value'];
                break;
        }
    }
}
// parseBetterPHP('ahi2h1i');

// Good
class Tokenizer
{
    protected $regexes = [
        '/[a-zA-Z]+/'
    ];

    public function tokenize(string $content)
    {
        $statements = explode(' ', $content);
        $tokens = [];

        foreach($statements as $statement) {
            foreach ($this->regexes as $regex) {
                if (preg_match($regex, $statement, $matches)) {
                    $tokens[] = [
                        'type' => gettype($matches[0]),
                        'value' => $matches[0],
                    ];
                }
            }
        }

        return $tokens;
    }
}

class Lexer
{
    public function lex(array $tokens)
    {
        $ast = [];
        foreach ($tokens as $token) {
            switch ($token['type']) {
                case 'string':
                    $ast[] = [
                        'type' => 'String',
                        'value' => $token['value'],
                    ];
                    break;
                case 'integer':
                    $ast[] = [
                        'type' => 'Integer',
                        'value' => $token['value'],
                    ];
                    break;
            }
        }

        return $ast;
    }
}

class ParseBetterPHP
{
    private $lexer;
    private $tokenizer;

    public function __construct(Lexer $lexer, Tokenizer $tokenizer)
    {
        $this->lexer = $lexer;
        $this->tokenizer = $tokenizer;
    }

    public function parse(string $content)
    {
        $tokens = $this->tokenizer->tokenize($content);
        $ast = $this->lexer->lex($tokens);
        foreach ($ast as $node) {
            switch ($node['type']) {
                case 'String':
                    echo $node['value'];
                    break;
                case 'Integer':
                    echo $node['value'];
                    break;
            }
        }
    }
}

$parser = new ParseBetterPHP(new Lexer, new Tokenizer);
$parser->parse('ahi2h1i');
```
4. Don't use flags as function parameters

`Function arguments - boolean arguments are a code smell`
```php
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
```

5. Don't write to global functions
```php
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
```

6. Don't use a Singleton pattern
```php
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
class Coin
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
```

7. Encapsulate conditionals
```php
class Asset
{
    public $name;
    public $state;

    public const AVAILABLE = 'available';
    public const UNAVAILABLE = 'unavailable';

    function __construct($name, $state)
    {
        $this->name = $name;
        $this->state = $state;
    }

    public function isAvailable()
    {
        return $this->state === self::AVAILABLE;
    }

    public function isUnavailable()
    {
        return $this->state === self::UNAVAILABLE;
    }
}

$newAsset = new Asset('New Asset', Asset::AVAILABLE);
// Encapsulate conditionals
// Bad
if ($newAsset->state === 'available') {
    echo "This asset is Available\n";
}

// Good
if ($newAsset->isAvailable()) {
    echo "This asset is Available\n";
}
```

8. Avoid conditionals
```php
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
```
### Comment
### Object and data structures
### Error Handling
### SOLID
1. Single Responsibility Principle

```A class should have one, and only one, reason to change.```
```php
// Example for Single Responsibility Principle
class User
{
    public function __construct()
    {
    }

    public function save()
    {
        // ...
    }

    public function update()
    {
        // ...
    }

    public function delete()
    {
        // ...
    }
}

```

2. Open-Closed Principle
3. Liskov Substitution Principle
4. Interface Segregation Principle
5. Dependency inversion principle
### Coding Convention in PHP
# **Effective Unit Testing**
## **What is the effective unit testing?**
## **Why should we use effective unit testing?**
## **How to write effective unit testing?**
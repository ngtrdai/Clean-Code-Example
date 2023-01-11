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
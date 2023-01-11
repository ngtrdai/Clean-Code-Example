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

    foreach ($statements as $statement) {
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

        foreach ($statements as $statement) {
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

$parser = new ParseBetterPHP(new Lexer(), new Tokenizer());
$parser->parse('ahi2h1i');

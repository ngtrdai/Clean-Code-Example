<?php

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

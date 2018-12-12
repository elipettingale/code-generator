<?php

namespace EliPett\CodeGeneration\Structs;

class Map
{
    private $data;

    public function __construct()
    {
        $this->data = json_decode(
            file_get_contents('/Users/elipettingale/.code_generation/map.json'), true
        );
    }

    public function hasProfile(string $path): bool
    {
        return array_key_exists($path, $this->data);
    }

    public function getProfile(string $path): Profile
    {
        return new Profile($this->data[$path]);
    }
}

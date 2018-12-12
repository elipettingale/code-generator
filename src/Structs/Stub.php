<?php

namespace EliPett\CodeGeneration\Structs;

class Stub
{
    private $name;
    private $path;
    private $target;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->path = $data['path'];
        $this->target = $data['target'];
    }

    public function scan(): array
    {
        // todo: scan for parameters

        return [];
    }

    public function run(array $parameters): void
    {
        // todo: get contents
        // todo: replace with parameters
        // todo: save file
    }
}

<?php

namespace EliPett\CodeGeneration\Structs;

class Generator
{
    private $name;
    private $stubs;

    public function __construct(array $data, array $stubs)
    {
        $this->name = $data['name'];
        $this->stubs = $stubs;
    }

    public function run(): void
    {
        $parameters = [];

        /** @var Stub $stub */
        foreach ($this->stubs as $stub) {
            foreach ($stub->parameters() as $parameter) {
                if (!\in_array($parameter, $parameters, false)) {
                    $parameters[] = $parameter;
                }
            }
        }

        var_dump($parameters);

        // todo: scan each stub for parameters
        // todo: ask for user input for each parameter
        // todo: run each stub passing parameters
    }
}

<?php

namespace EliPett\CodeGeneration\Structs;

class Generator
{
    public $name;
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

        $values = [];

        foreach ($parameters as $parameter) {
            $values[$parameter] = readline($parameter . ': ');
        }

        /** @var Stub $stub */
        foreach ($this->stubs as $stub) {
            $stub->generate($values);
        }
    }
}

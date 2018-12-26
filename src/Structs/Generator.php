<?php

namespace EliPett\CodeGeneration\Structs;

use EliPett\CodeGeneration\CodeGenerator;

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
        CodeGenerator::info("Running Generator: {$this->name} \n");

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
            $values[$parameter] = CodeGenerator::ask($parameter);
        }

        echo "\n";

        /** @var Stub $stub */
        foreach ($this->stubs as $stub) {
            $stub->generate($values);
            CodeGenerator::info("Generated: {$stub->name}\n");
        }
    }
}

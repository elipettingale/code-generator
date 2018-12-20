<?php

namespace EliPett\CodeGeneration\Structs;

class Profile
{
    public $name;
    private $generators;

    public function __construct(string $name)
    {
        $path = '/Users/' . get_current_user() . "/.code_generation/profiles/{$name}";

        $data = json_decode(
            file_get_contents("{$path}/profile.json"), true
        );

        $this->name = $data['name'];

        foreach ($data['generators'] as $generator) {
            $stubs = [];

            foreach ($generator['stubs'] as $stub) {
                $stubs[$stub['name']] = new Stub([
                    'name' => $stub['name'],
                    'path' => $path . '/stubs/' . $stub['path'],
                    'target' => $stub['target']
                ]);
            }

            $this->generators[$generator['alias']] = new Generator([
                'name' => $generator['name']
            ], $stubs);
        }
    }

    public function getGenerator(string $name): Generator
    {
        if (!array_key_exists($name, $this->generators)) {
            throw new \InvalidArgumentException("Generator Not Found: $name");
        }

        return $this->generators[$name];
    }
}

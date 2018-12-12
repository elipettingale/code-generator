<?php

namespace EliPett\CodeGeneration\Structs;

class Profile
{
    private $name;
    private $path;
    private $generators;

    public function __construct(string $name)
    {
        $this->path = '/Users/' . get_current_user() . "/.code_generation/profiles/{$name}";

        $data = json_decode(
            file_get_contents("{$this->path}/profile.json"), true
        );

        $this->name = $data['name'];

        foreach ($data['generators'] as $generator) {
            $stubs = [];

            foreach ($generator['stubs'] as $stub) {
                $stubs[$stub['name']] = new Stub([
                    'name' => $stub['name'],
                    'path' => $this->path . '/stubs/' . $stub['path'],
                    'target' => $stub['target']
                ]);
            }

            $this->generators[$generator['name']] = new Generator([
                'name' => $generator['name']
            ], $stubs);
        }
    }

    public function hasGenerator(string $name): bool
    {
        return array_key_exists($name, $this->generators);
    }

    public function getGenerator(string $name): Generator
    {
        return $this->generators[$name];
    }
}

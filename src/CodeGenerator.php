<?php

namespace EliPett\CodeGeneration;

class CodeGenerator
{
    private $profile;

    private function map(string $path = null)
    {
        $map = json_decode(
            file_get_contents(__DIR__ . '/../../../../../.code_generation/map.json'), true
        );

        if ($path !== null) {
            if (!array_key_exists($path, $map)) {
                return null;
            }

            return $map[$path];
        }

        return $map;
    }

    private function profile(string $name): array
    {
        return json_decode(
            file_get_contents(__DIR__ . "/../../../../../.code_generation/profiles/{$name}.json"), true
        );
    }

    private function hasProfile(string $path): bool
    {
        return $this->map($path) !== null;
    }

    private function loadProfile(string $path): void
    {
        $this->profile = $this->profile(
            $this->map($path)
        );
    }

    public function load(string $path): bool
    {
        if ($this->hasProfile($path)) {
            $this->loadProfile($path);

            return true;
        }

        return false;
    }

    public function run(string $key): void
    {
        // todo: run generator
    }
}

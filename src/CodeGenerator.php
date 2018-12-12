<?php

namespace EliPett\CodeGeneration;

class CodeGenerator
{
    private $profile;

    private function profiles(): array
    {
        return json_decode(
            file_get_contents(__DIR__ . '/../../../../../.code_generation/profiles.json'), true
        );
    }

    private function hasProfile(string $path): bool
    {
        return array_key_exists($path, $this->profiles());
    }

    private function setProfile(string $path): void
    {
        $this->profile = $this->profiles()[$path];
    }

    public function load(string $path): bool
    {
        if ($this->hasProfile($path)) {
            $this->setProfile($path);

            return true;
        }

        return false;
    }

    public function run(string $key): void
    {
        // todo: run generator
    }
}

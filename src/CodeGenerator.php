<?php

namespace EliPett\CodeGeneration;

use EliPett\CodeGeneration\Structs\Map;
use EliPett\CodeGeneration\Structs\Profile;

class CodeGenerator
{
    /** @var Map */
    private $map;

    /** @var Profile */
    private $profile;

    public function __construct()
    {
        $this->map = new Map();
    }

    public function load(string $path): bool
    {
        if ($this->map->hasProfile($path)) {
            $this->profile = $this->map->getProfile($path);

            return true;
        }

        readline_completion_function(function($input) {
            $profiles = $this->map->getAvailableProfiles();
            $matches = [];

            foreach ($profiles as $profile) {
                if (stripos($profile, $input) === 0) {
                    $matches[] = $profile;
                }
            }

            if (\count($matches) === 0) {
                return null;
            }

            return $matches;
        });

        $profile = ask('Profile');

        $this->map->setProfile($path, $profile);
        $this->map->save();

        echo "\n";

        return $this->load($path);
    }

    public function run(string $name): void
    {
        try {

            $this->profile
                ->getGenerator($name)
                ->run();

        } catch (\Exception $exception) {
            error($exception->getMessage() . "\n");
        }
    }
}

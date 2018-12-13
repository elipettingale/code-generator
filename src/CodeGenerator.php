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

        $profile = readline('Use Profile: ');

        $this->map->setProfile($path, $profile);
        $this->map->save();

        return $this->load($path);
    }

    public function run(string $name): bool
    {
        if (!$this->profile->hasGenerator($name)) {
            echo "Generator Not Found: $name \n";

            return false;
        }

        $generator = $this->profile->getGenerator($name);
        $generator->run();

        return true;
    }
}

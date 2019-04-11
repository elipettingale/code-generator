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

        $profile = self::ask('Profile');

        $this->map->setProfile($path, $profile);
        $this->map->save();


        echo "\n";

        return $this->load($path);
    }

    public function run(string $name)
    {
        try {

            $this->profile
                ->getGenerator($name)
                ->run();

        } catch (\Exception $exception) {
            self::error($exception->getMessage() . "\n");
        }
    }

    public static function error(string $text)
    {
        echo "\033[31m{$text}\033[0m";
    }

    public static function info(string $text)
    {
        echo "\033[34m{$text}\033[0m";
    }

    public static function ask(string $text)
    {
        echo "\n";
        echo " \033[32mEnter {$text}:\033[0m \n";
        return trim(readline(' > '));
    }

    public static function config_path(string $path): string
    {
        return $_SERVER['HOME'] . '/.code_generation/' . $path;
    }
}

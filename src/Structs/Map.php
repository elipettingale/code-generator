<?php

namespace EliPett\CodeGeneration\Structs;

class Map
{
    private $path;
    private $data;

    public function __construct()
    {
        $this->path = config_path('map.json');

        $this->data = json_decode(
            file_get_contents($this->path), true
        );
    }

    public function getAvailableProfiles(): array
    {
        $profiles = scandir(config_path('profiles'), SCANDIR_SORT_ASCENDING);

        return array_diff($profiles, ['.', '..', '.DS_Store']);
    }

    public function hasProfile(string $path): bool
    {
        return array_key_exists($path, $this->data);
    }

    public function getProfile(string $path): Profile
    {
        return new Profile($this->data[$path]);
    }

    public function setProfile(string $path, string $profile): void
    {
        $this->data[$path] = $profile;
    }

    public function save(): bool
    {
        return file_put_contents(
            $this->path,
            json_encode($this->data, JSON_PRETTY_PRINT)
        );
    }
}

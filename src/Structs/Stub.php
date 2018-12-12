<?php

namespace EliPett\CodeGeneration\Structs;

use EliPett\CaseConverter\Enums\CaseConversion;

class Stub
{
    private $name;
    private $path;
    private $target;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->path = $data['path'];
        $this->target = $data['target'];
    }

    public function parameters(): array
    {
        $contents = file_get_contents($this->path);

        $parameters = [];

        $conversions = [
            'NO_CASE',
            CaseConversion::LOWER_CASE,
            CaseConversion::UPPER_CASE,
            CaseConversion::TIGHT_CASE,
            CaseConversion::LOWER_SNAKE_CASE,
            CaseConversion::UPPER_SNAKE_CASE,
            CaseConversion::LOWER_CAMEL_CASE,
            CaseConversion::UPPER_CAMEL_CASE,
            CaseConversion::LOWER_HYPHEN_CASE,
            CaseConversion::UPPER_HYPHEN_CASE
        ];

        foreach ($conversions as $conversion) {
            preg_match_all('/\$([A-Z,_]+)_' . strtoupper($conversion) . '\$/', $contents, $matches);
            foreach ($matches[1] as $parameter) {
                if (!\in_array($parameter, $parameters, false)) {
                    $parameters[] = $parameter;
                }
            }
        }

        return $parameters;
    }

    public function generate(array $parameters): void
    {
        // todo: get contents
        // todo: replace with parameters
        // todo: save file
    }
}

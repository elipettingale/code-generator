<?php

namespace EliPett\CodeGeneration\Structs;

use EliPett\CaseConverter\Enums\CaseConversion;

class Stub
{
    public $name;
    private $path;
    private $target;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->path = $data['path'];
        $this->target = $data['target'];
    }

    private function contents()
    {
        if (!file_exists($this->path)) {
            throw new \InvalidArgumentException("Invalid Stub Path: {$this->path}");
        }
        return file_get_contents($this->path);
    }

    private function targetDirectory()
    {
        return $this->target['directory'];
    }

    private function targetFilename()
    {
        return $this->target['file_name'];
    }

    public function parameters(): array
    {
        $parameters = $this->scan(
            $this->contents()
        );

        $parameters = array_merge(
            $parameters, $this->scan($this->targetDirectory())
        );

        $parameters = array_merge(
            $parameters, $this->scan($this->targetFilename())
        );

        return array_unique($parameters);
    }

    private function scan(string $contents): array
    {
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

    public function generate(array $parameters)
    {
        $contents = $this->filter(
            $this->contents(), $parameters
        );

        $directory = $this->filter(
            $this->targetDirectory(), $parameters
        );

        $filename = $this->filter(
            $this->targetFilename(), $parameters
        );

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($directory . '/' . $filename, $contents);
    }

    private function filter(string $contents, array $parameters): string
    {
        foreach ($parameters as $key => $value) {
            $contents = str_replace(
                [
                    '$' . strtoupper($key) . '_' . strtoupper('NO_CASE') . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::LOWER_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::UPPER_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::TIGHT_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::LOWER_SNAKE_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::UPPER_SNAKE_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::LOWER_CAMEL_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::UPPER_CAMEL_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::LOWER_HYPHEN_CASE) . '$',
                    '$' . strtoupper($key) . '_' . strtoupper(CaseConversion::UPPER_HYPHEN_CASE) . '$',
                    '$NOW$'
                ],
                [
                    $value,
                    lower_case($value),
                    upper_case($value),
                    tight_case($value),
                    lower_snake_case($value),
                    upper_snake_case($value),
                    lower_camel_case($value),
                    upper_camel_case($value),
                    lower_hyphen_case($value),
                    upper_hyphen_case($value),
                    date('Y_m_d_His')
                ],
                $contents
            );
        }

        return $contents;
    }
}

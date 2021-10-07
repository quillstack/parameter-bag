<?php

declare(strict_types=1);

namespace Quillstack\ParameterBag;

class ParameterBag
{
    public function __construct(private array $parameters)
    {
        //
    }

    public function set(string $name, $value): void
    {
        $this->parameters[$name] = $value;
    }

    public function has(string $name): bool
    {
        return isset($this->parameters[$name]);
    }

    public function remove(string $name): bool
    {
        if (!isset($this->parameters[$name])) {
            return false;
        }

        unset($this->parameters[$name]);

        return true;
    }

    public function get(string $name, $default = null): mixed
    {
        if (!isset($this->parameters[$name])) {
            return $default;
        }

        return $this->parameters[$name];
    }

    public function all(): array
    {
        return $this->parameters;
    }
}

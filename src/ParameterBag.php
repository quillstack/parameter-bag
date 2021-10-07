<?php

declare(strict_types=1);

namespace Quillstack\ParameterBag;

class ParameterBag
{
    public function __construct(private array $parameters = [])
    {
        //
    }

    public function set(string $name, $value): self
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    public function remove(string $name): bool
    {
        if (!$this->has($name)) {
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

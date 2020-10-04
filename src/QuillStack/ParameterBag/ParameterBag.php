<?php

declare(strict_types=1);

namespace QuillStack\ParameterBag;

final class ParameterBag
{
    /**
     * @var array
     */
    private array $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param string $name
     * @param $value
     */
    public function set(string $name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->parameters[$name]);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function remove(string $name): bool
    {
        if (!isset($this->parameters[$name])) {
            return false;
        }

        unset($this->parameters[$name]);

        return true;
    }

    /**
     * @param string $name
     * @param null $default
     *
     * @return mixed|null
     */
    public function get(string $name, $default = null)
    {
        if (!isset($this->parameters[$name])) {
            return $default;
        }

        return $this->parameters[$name];
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->parameters;
    }
}

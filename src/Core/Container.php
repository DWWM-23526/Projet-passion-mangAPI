<?php

namespace Core;
use Exception;

class Container
{
    private array $instances = [];

    public function setContainer(string $key, callable $resolver)
    {
        $this->instances[$key] = $resolver;
    }

    public function getContainer(string $key)
    {
        if (isset($this->instances[$key])) {
            
            if (is_callable($this->instances[$key])) {
                $this->instances[$key] = call_user_func($this->instances[$key]);
            }
            return $this->instances[$key];
        }

        throw new Exception("Error {$key} does not exist");
    }
}
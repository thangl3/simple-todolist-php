<?php
namespace Helper\Route;

class RouteGroup
{
    public function __construct(string $pattern, callable $callable)
    {
        $this->pattern = $pattern;
        $this->callable = $callable;
    }

    public function __invoke($route)
    {
        $callable = $this->callable;

        if ($callable instanceof \Closure && $route !== null) {
            $callable = $callable->bindTo($route);
        }

        $callable($route);
    }
}
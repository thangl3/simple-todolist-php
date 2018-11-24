<?php
namespace Helper\Route;

use Exception;

class Router
{
    private $routes = [];
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addRoute(string $method, string $pattern, callable $callback)
    {
        $this->routes[$method][$pattern] = $callback;
    }

    public function getRoutes(string $method)
    {
        return $this->routes[$method];
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function lookupRoute(string $method, string $pattern)
    {
        if (isset($this->routes[$method][$pattern])) {
            return $this->routes[$method][$pattern];
        }

        throw new Exception('Not found this route');
    }
}
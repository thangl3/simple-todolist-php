<?php
namespace Helper\Route;

use Helper\Route\Exception\NotFoundException;

class Router
{
    private $routes = [];
    private $groupPattern;
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addRoute(string $method, string $pattern, callable $callback)
    {
        if ($this->getGroupPattern() !== null) {
            $pattern = $this->getGroupPattern() .$pattern;
        }

        $this->routes[$method][$pattern] = $callback;
    }

    public function createGroup(string $pattern, callable $callable)
    {
        $this->setGroupPattern($pattern);

        return new RouteGroup($pattern, $callable);
    }

    public function flushGroup()
    {
        $this->setGroupPattern(null);
    }

    public function getRoutes(string $method)
    {
        return $this->routes[$method];
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setGroupPattern($pattern)
    {
        $this->groupPattern = $pattern;
    }

    public function getGroupPattern()
    {
        return $this->groupPattern;
    }

    public function lookupRoute(string $method, string $pattern)
    {
        if (isset($this->routes[$method][$pattern])) {
            return $this->routes[$method][$pattern];
        }

        throw new NotFoundException($this->container->request, $this->container->response);
    }
}
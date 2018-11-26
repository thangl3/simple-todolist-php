<?php
namespace Helper\Route;

use Helper\Route\Exception\NotFoundException;

class Router
{
    private $routes = [];
    private $groupRoutes = [];
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

    public function pushGroup(string $pattern, callable $callable)
    {
        $group = new RouteGroup($pattern, $callable);
        array_push($this->groupRoutes, $group);
        $this->setGroupPattern($pattern);

        return $group;
    }

    public function popGroup()
    {
        array_pop($this->groupRoutes);
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
        return $this->groupPattern ?? '';
    }

    public function lookupRoute(string $method, string $pattern)
    {
        if (isset($this->routes[$method][$pattern])) {
            return $this->routes[$method][$pattern];
        }

        throw new NotFoundException($this->container->request, $this->container->response);
    }
}
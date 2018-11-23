<?php
namespace Helper\Route;

use Helper\Route\Http\Method;

class Route
{
    private $container;
    private $callableResolver;

    public function __construct(array $settings = [])
    {
        $this->container = new Container($settings);
        $this->callableResolver = new CallableResolver($this->container);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function get(string $pattern, $callable)
    {
        $this->map(Method::$GET, $pattern, $callable);
    }

    public function post(string $pattern, $callable)
    {
        $this->map(Method::$POST, $pattern, $callable);
    }

    private function map(string $method, string $pattern, $callable)
    {
        $callableResolved = $this->callableResolver->resolve($callable);
        
        $router = $this->container->get('router')->addRoute($method, $pattern, $callableResolved);
    }

    public function handle()
    {
        dump($this->container->get('request')->getParams());
        die;
    }
}

<?php
namespace Helper\Route;

use Exception;
use Throwable;
use Helper\Route\Http\Method;
use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use Helper\Route\Exception\NotFoundException;

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
        
        $router = $this->container->router->addRoute($method, $pattern, $callableResolved);
    }

    public function handle()
    {
        $request = $this->container->request;
        $response = $this->container->response;

        // exception handling
        try {
            $method = $request->getMethod();
            $requestTarget = $request->getRequestTarget();

            $routeCallable = $this->container->router->lookupRoute($method, $requestTarget);

            // call callback of route
            $response = $routeCallable($request, $response);
        } catch (Exception $e) {
            $response = $this->handleException($e, $request, $response);
        }

        return $response->write($response->getBody());
    }

    private function handleException(Exception $error, Request $request, Response $response)
    {
        $handler = $this->container->get('exceptionHandler');

        if ($error instanceof NotFoundException) {
            $handler = $this->container->get('notFoundHandler');
        }

        if (is_callable($handler)) {
            // call the closure if custom has overrided runtimeErrorHandler in default service
            return call_user_func_array($handler, [$error, $request, $response]);
        } else {
            // Call the return of closure had registered in default service
            return $handler;
        }
    }
}

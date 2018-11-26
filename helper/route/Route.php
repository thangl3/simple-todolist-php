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

    /****************************************************
     * Route method
     ****************************************************/

    public function get(string $pattern, $callable)
    {
        $this->map(Method::GET, $pattern, $callable);
    }

    public function post(string $pattern, $callable)
    {
        $this->map(Method::POST, $pattern, $callable);
    }

    public function put(string $pattern, $callable)
    {
        $this->map(Method::PUT, $pattern, $callable);
    }

    public function patch(string $pattern, $callable)
    {
        $this->map(Method::PATCH, $pattern, $callable);
    }

    public function delete(string $pattern, $callable)
    {
        $this->map(Method::DELETE, $pattern, $callable);
    }

    /***************************************************
     * Route group method
     ***************************************************/

    public function group(string $pattern, $callable)
    {
        $callableResolved = $this->callableResolver->resolve($callable);
        
        $groupRoute = $this->container->router->createGroup($pattern, $callableResolved);

        $groupRoute($this);

        $this->container->router->flushGroup();
    }

    /**
     * Received all request of user and handle
     *
     * @return void
     */
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

    private function map(string $method, string $pattern, $callable)
    {
        $callableResolved = $this->callableResolver->resolve($callable);
        
        $router = $this->container->router->addRoute($method, $pattern, $callableResolved);
    }

    private function handleException(Exception $error, Request $request, Response $response)
    {
        $handler = $this->container->get('exceptionHandler');

        if ($error instanceof NotFoundException) {
            $handler = $this->container->get('notFoundHandler');
        }

        // call the closure if custom has overrided runtimeErrorHandler in default service
        if ($handler instanceof \Closure) {
            return call_user_func_array($handler, [$error, $request, $response]);
        } elseif (is_callable($handler)) {
            $handler($error, $request, $response);
        } else {
            // Call the return of closure had registered in default service
            return $handler;
        }
    }
}
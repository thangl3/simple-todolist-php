<?php

namespace Helper\Route;

use RuntimeException;

class CallableResolver
{
    private $container;

    /**
     * Pass container will contain DI method
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Detact callback of user are string or callable callback
     * Convert from string to callable callback if it's string
     * Binding the container (DI) to arguments if it's callable
     *
     * @param [string, callable] $toResolve
     * @return callable
     */
    public function resolve($toResolve) : callable
    {
        $resolved = $toResolve;

        if (is_callable($toResolve)) {
            $resolved = $resolved->bindTo($this->container);
        } elseif (is_string($toResolve)) {
            // create and call object as a function if user just provided class
            $class = $toResolve;
            $method = '__invoke';

            // the rule for checking callable whether pass format as "class@method" like laravel
            $callablePattern = '!^([^\:]+)\@([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)$!';

            if (preg_match($callablePattern, $toResolve, $matches)) {
                $class = $matches[1];
                $method = $matches[2];
            }

            if (!class_exists($class)) {
                throw new RuntimeException('Class name ' .$class .' does not exist');
            }

            $resolved = [new $class($this->container), $method];
        } else {
            throw new RuntimeException('Route does not support this type of callback!');
        }

        return $resolved;
    }
}

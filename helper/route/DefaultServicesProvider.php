<?php
namespace Helper\Route;

use Helper\Route\Http\Environment;
use Helper\Route\Http\Request;
use Helper\Route\Http\Response;

class DefaultServicesProvider
{
    private $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function register($container)
    {
        if (!isset($container['environment'])) {
            $container['environment'] = function () {
                return new Environment($_SERVER);
            };
        }

        if (!isset($container['settings'])) {
            $container['settings'] = function () {
                return new Setting($this->settings);
            };
        }

        if (!isset($container['request'])) {
            $container['request'] = function ($container) {
                return new Request($container->get('environment'));
            };
        }

        if (!isset($container['response'])) {
            $container['response'] = function () {
                return new Response();
            };
        }

        if (!isset($container['router'])) {
            $container['router'] = function ($container) {
                return new Router($container);
            };
        }

        if (!isset($container['exceptionHandler'])) {
            // Closure recieved all exception of app
            $container['exceptionHandler'] = function ($container) {
                return function($error, $request, $response) {
                    return $response->write($error);
                };
            };
        }
    }
}
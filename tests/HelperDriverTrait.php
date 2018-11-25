<?php
namespace Test;

trait HelperDriverTrait
{
    final public function mockRoute()
    {
        $settings = [
            'db' => [
                'database' => 'simple_todo',
                'host' => 'localhost',
                'port' => 3306,
                'username' => 'root',
                'password' => ''
            ],
            'viewPath' => __DIR__ .'/../src/view'
        ];
        
        $route = new \Helper\Route\Route($settings);

        return $route;
    }

    final public function mockContainer()
    {
        $route = $this->mockRoute();

        $container = $route->getContainer();
        
        $container['db'] = function($container) {
            $db = $container->settings['db'];
        
            $pdo = new \PDO(
                "mysql:host=" . $db['host'] . ";dbname=" . $db['database'],
                $db['username'],
                $db['password']
            );
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        
            return $pdo;
        };

        return $container;
    }

    final public function mockPostRequestWithParams(array $params)
    {
        $container = $this->mockContainer();
        $request = $container->request;

        $request->setIsPostMethod();

        $request->withBodyParams($params);

        return $request;
    }
}
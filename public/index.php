<?php

require __DIR__ . '/../vendor/autoload.php';

$settings = [
    'db' => [
        'database' => getenv('DB_NAME'),
        'host' => getenv('DB_HOST'),
        'port' => getenv('DB_PORT'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD')
    ],
];

$route = new \Helper\Route\Route($settings);

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

$route->get('/list', App\Controller\HomeController::class .'@index');
$route->get('/list2', App\Controller\HomeController::class .'@index');
$route->get('/list3', App\Controller\HomeController::class .'@index');
$route->get('/list4', App\Controller\HomeController::class .'@index');

$route->handle();
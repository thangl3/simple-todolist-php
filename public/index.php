<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controller\HomeController;
use App\Controller\CreateController;
use App\Controller\UpdateController;
use App\Controller\DeleteController;

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
$container = $route->getContainer();

$container['db'] = function ($container) {
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

$container['view'] = function ($container) {
    return new Helper\View\ViewEngine($container->settings['viewPath']);
};

$route->get('/',                HomeController::class   .'@index');

$route->group('/api', function () {
    $this->get('/works',        HomeController::class   .'@fetchWorks');
    $this->get('/work',         HomeController::class   .'@fetchWork');
    $this->post('/work',        CreateController::class .'@createWork');
    $this->put('/work',         UpdateController::class .'@updateWork');
    $this->patch('/work',       UpdateController::class .'@updateStatus');
    $this->delete('/work',      DeleteController::class .'@deleteWork');
});

$route->handle();
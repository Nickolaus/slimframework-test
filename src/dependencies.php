<?php
// DIC configuration

use SlimTest\Controller\HomeController;

$container = $app->getContainer();

// view renderer
$container['view'] = function ($container) {
    $settings = $container->get('settings')['view'];
    $view = new Slim\Views\Twig($settings['template_path'], array(
        'cache' => $settings['cache_path']
    ));
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->addExtension(new Twig_Extension_Optimizer(Twig_NodeVisitor_Optimizer::OPTIMIZE_ALL));
    return $view;
};

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['db'] = function ($container) {
    $db = $container['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['HomeController'] = function ($container) {
    $controller = new HomeController();
    $controller->setContainer($container);
    return $controller;
};
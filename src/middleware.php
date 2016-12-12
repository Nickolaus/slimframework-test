<?php

use \Jgut\Slim\Controller\Resolver;

// Application middleware

$container = $app->getContainer();

// e.g: $app->add(new \Slim\Csrf\Guard);


$container['csrf'] = function ($container) {
   return new \Slim\Csrf\Guard;
};



// Define your controllers
$controllers = [
    'SlimTest\Controller\HomeController',
];

// Register Controllers
foreach (Resolver::resolve($controllers) as $controller => $callback) {
    $container[$controller] = $callback;
}
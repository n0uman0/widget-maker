<?php

require dirname( __FILE__ ) . '/vendor/autoload.php';
//include_once 'src/Router/Routes.php';
use WidgetMaker\Container\Container;

$container = new Container();

$container->bind(WidgetMaker\Controllers\Product::class, function($container) {
    return new WidgetMaker\Controllers\Product(
        $container->make(WidgetMaker\Repositories\ProductRepository::class)
    );
});

$container->bind(WidgetMaker\Controllers\Basket::class, function($container) {
    return new WidgetMaker\Controllers\Basket(
        $container->make(WidgetMaker\Repositories\ProductRepository::class)
    );
});

$router = new WidgetMaker\Router\Routes( $container );

$router->add('GET', '/products', [WidgetMaker\Controllers\Product::class, 'getAll']);
$router->add('GET', '/products/{id}', [WidgetMaker\Controllers\Product::class, 'get']);

$router->add('POST', '/basket', [WidgetMaker\Controllers\Basket::class, 'process']);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($path); 
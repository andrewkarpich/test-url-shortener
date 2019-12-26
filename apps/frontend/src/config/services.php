<?php

use Phalcon\Crypt;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

$container->set('config', $config);

$container->set('dispatcher', new Dispatcher());

$container->set('request', new Request());
$container->set('response', new Response());

$container->set('router', function (){

    $router = new Router();

    $router->removeExtraSlashes(true);

    $router->setDefaultNamespace('Frontend\Controllers');
    $router->setDefaultController('index');
    $router->setDefaultAction('index');

    return $router;
});


$container->set('url', function () use ($config) {
    $url = new Url();
    $url->setBaseUri($config->url);
    $url->setStaticBaseUri($config->url);

    return $url;
});

$container->set('crypt', function () use ($config) {
    $crypt = new Crypt();
    $salt = substr($config->apps->cryptSalt, 0, 32);
    $crypt->setKey($salt);

    return $crypt;
});


$container->set('volt', function($view, $container) {

    $volt = new Volt($view, $container);

    $volt->setOptions([
        'compiledPath' => function($templatePath) {

            $dir = ROOT_PATH . '/cache/templates/';

            if(!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)){
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
            }

            return $dir . md5($templatePath) . '.compiled';
        },
    ]);

    return $volt;
});


$container->set('view', function() {
    $view = new View();

    $view->registerEngines([
        '.volt' => 'volt',
    ]);

    $view->setViewsDir(ROOT_PATH . 'src/views');

    return $view;
});

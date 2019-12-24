<?php

use Phalcon\Crypt;
use Phalcon\Db\Adapter\Pdo\Postgresql;
use Phalcon\Mvc\Url;

$container->set('config', $config);

$container->set('url', function () use ($config) {
    $url = new Url();
    $url->setBaseUri($config->url);
    $url->setStaticBaseUri($config->url);

    return $url;
});

$container->set('db', function () use ($config, $container) {

    $eventsManager = $container->getShared('eventsManager');

    $descriptor = [
        'host' => $config->database->postgres->host,
        'username' => $config->database->postgres->username,
        'password' => $config->database->postgres->password,
        'dbname' => $config->database->postgres->dbname,
        'port' => $config->database->postgres->port
    ];

    if (isset($config->database->postgres->dsn)) {
        $descriptor['dsn'] = $config->database->postgres->dsn;
    }

    $connection = new Postgresql($descriptor);

    $connection->setEventsManager($eventsManager);

    return $connection;

}, true);

$container->set('crypt', function () use ($config) {
    $crypt = new Crypt();
    $salt = substr($config->apps->cryptSalt, 0, 32);
    $crypt->setKey($salt);

    return $crypt;
});


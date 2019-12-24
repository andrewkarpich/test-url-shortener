<?php

use Backend\Phalcon\JsonRpcApplication;
use Backend\Phalcon\JsonRpcDispatcher;
use Phalcon\Config;
use Phalcon\Di\FactoryDefault\Cli;

/**
 * @var Config $config
 */
$config = require 'config.php';

require ROOT_PATH . 'vendor/autoload.php';

$container = new Cli();

require CONFIG_PATH . 'services.php';

$application = new JsonRpcApplication();

$container->set('dispatcher', new JsonRpcDispatcher());

$container->set('application', $application);

$application->setDI($container);

$application->run();
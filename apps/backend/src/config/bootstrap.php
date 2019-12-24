<?php

use Backend\Phalcon\JsonRpcApplication;
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

$container->set('application', $application);

$application->setDI($container);

$application->run();
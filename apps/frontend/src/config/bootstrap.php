<?php

use Phalcon\Config;
use Phalcon\Di\FactoryDefault\Cli;
use Phalcon\Mvc\Application;

/**
 * @var Config $config
 */
$config = require 'config.php';

require ROOT_PATH . 'vendor/autoload.php';

$container = new Cli();

require CONFIG_PATH . 'services.php';

$application = new Application($container);

$container->set('application', $application);

try {

    $application->handle()->send();

} catch (Throwable $exception) {

    // TODO: LOG THIS CASE

}
<?php

use Phalcon\Security\Random;

$env = getenv('ENVIRONMENT');
if(!$env) $env = 'local';

$config = new \Phalcon\Config([

    'env' => $env,

    'debug' => true,

    'url' => '/',

    'database' => [
        'postgres' => [
            'adapter'  => 'pgsql',
            'host'     => 'postgres',
            'dbname'   => 'test',
            'username' => 'test',
            'password' => 'TWq6zVfy6WejdJ3THMJS',
            'port'     => 5432,
        ],
    ],

    'application' => [
        'namespaces' => [
            'App' => __DIR__ . '/../',
        ],

        'dirs' => [],
    ],

    'secure' => [
        'method' => 'AES-256-CTR',
        'vector' => 'UbmPw4S3dvk2tb6L3mx3Fp4taUR29CfX',
        'salt'   => '9m3fVMc@857Quf%1?gR#WfC%8Ec%5s&cjPa77N2F!rgK^3B9sHasuLYhuYz-aEZjFPBk',
    ],

]);

/**
 * Merge with env config
 */


$config_mode = $env;
if($config_mode !== 'my'){
    $config_fname = CONFIG_PATH . "env/config.$config_mode.php";
    if(file_exists($config_fname)){
        /** @noinspection PhpIncludeInspection */
        $config->merge(require $config_fname);
    }
}

/**
 * Merge with my local config
 */

if(file_exists(CONFIG_PATH . 'env/config.my.php')){
    $config->merge(require CONFIG_PATH . 'env/config.my.php');
}

return $config;
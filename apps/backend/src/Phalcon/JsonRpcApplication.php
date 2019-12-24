<?php

namespace Backend\Phalcon;


use Datto\JsonRpc\Http\Server;
use Phalcon\Cli\Console;
use Phalcon\Http\Response;

class JsonRpcApplication extends Console {

    public function run() {

        header('X-XSS-Protection: 1;mode=block');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, cache-control');

        $server = new Server(new JsonRpcEvaluator());

        $server->reply();

    }

}
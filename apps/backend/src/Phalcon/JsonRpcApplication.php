<?php

namespace Backend\Phalcon;


use Datto\JsonRpc\Http\Server;
use Phalcon\Cli\Console;

class JsonRpcApplication extends Console {

    public function run() {

        $response = $this->di->get('response');

        $response->setHeader('X-XSS-Protection', '1;mode=block');
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('Access-Control-Allow-Origin', 'http://localhost:8080');
        $response->setHeader('Access-Control-Allow-Methods', 'GET,POST,PATCH,PUT,DELETE,OPTIONS');
        $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, cache-control');

        $server = new Server(new JsonRpcEvaluator());

        $server->reply();

    }

}
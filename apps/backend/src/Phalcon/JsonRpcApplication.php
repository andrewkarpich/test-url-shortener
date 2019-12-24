<?php

namespace Backend\Phalcon;


use Datto\JsonRpc\Http\Server;
use Phalcon\Cli\Console;

class JsonRpcApplication extends Console {

    public function run(){

        $server = new Server(new JsonRpcEvaluator());

        $server->reply();

    }

}
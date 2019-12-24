<?php

namespace Backend\Controllers;

use Backend\Phalcon\JsonRpcController;

class TestController extends JsonRpcController {

    public function addAction(int $a, int $b){

        return $a + $b;

    }

}
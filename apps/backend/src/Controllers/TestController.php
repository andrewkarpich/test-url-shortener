<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrewkarpich
 * Date: 24/12/2019
 * Time: 00:52
 */

namespace Backend\Controllers;

use Backend\Phalcon\JsonRpcController;

class TestController extends JsonRpcController {

    public function addAction(int $a, int $b){

        return $a + $b;

    }

}
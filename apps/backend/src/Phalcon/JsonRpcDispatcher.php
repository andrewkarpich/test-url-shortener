<?php

namespace Backend\Phalcon;


use Phalcon\Cli\Dispatcher;

class JsonRpcDispatcher extends Dispatcher
{

    protected $_handlerSuffix = 'Controller';

    /**
     * Calls the action method.
     * @param $handler
     * @param $actionMethod
     * @param array|null $params
     * @return mixed
     */
    public function callActionMethod($handler, $actionMethod, array $params = null)
    {

        return \call_user_func_array([$handler, $actionMethod], array_merge($params, $this->_options));

    }

}
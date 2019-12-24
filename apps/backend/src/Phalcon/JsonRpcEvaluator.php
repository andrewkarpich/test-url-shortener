<?php

namespace Backend\Phalcon;

use Datto\JsonRpc\Evaluator;
use Datto\JsonRpc\Exceptions\ApplicationException;
use Datto\JsonRpc\Exceptions\ArgumentException;
use Datto\JsonRpc\Exceptions\MethodException;
use Phalcon\Di\Injectable;

class JsonRpcEvaluator extends Injectable implements Evaluator
{


    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws ArgumentException
     * @throws ApplicationException
     * @throws MethodException
     * @throws \Datto\JsonRpc\Exceptions\Exception
     */
    public function evaluate($method, $arguments)
    {

        [$task, $action] = explode('_', $method);

        $arguments = [
            'task' => $task,
            'action' => $action,
            'params' => $arguments
        ];

        $dispatcher = $this->di->get('dispatcher');

        $dispatcher->setNamespaceName('Backend\\Controllers');

        try {

            $this->di->get('application')->handle($arguments);

        } catch (\TypeError $exception) {

            throw new ArgumentException();

        } catch (\Exception $exception) {

            if (!($exception instanceof \Datto\JsonRpc\Exceptions\Exception)) {

                switch ($exception->getCode()) {
                    case JsonRpcDispatcher::EXCEPTION_CYCLIC_ROUTING:
                    case JsonRpcDispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                    case JsonRpcDispatcher::EXCEPTION_ACTION_NOT_FOUND:
                        throw new MethodException();
                    case JsonRpcDispatcher::EXCEPTION_INVALID_PARAMS:
                        throw new ArgumentException();
                    default:
                        throw new ApplicationException($exception->getMessage(), $exception->getCode());
                }
            }

            throw $exception;
        }

        return $dispatcher->getReturnedValue();
    }
}
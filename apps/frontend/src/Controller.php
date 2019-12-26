<?php
/**
 * Created by IntelliJ IDEA.
 * User: andrewkarpich
 * Date: 26/12/2019
 * Time: 22:31
 */

namespace Frontend;


class Controller extends \Phalcon\Mvc\Controller
{

    public function sendJson($data): bool {

        $this->view->disable();

        $this->response->setContentType('application/json', 'utf-8');
        $this->response->setJsonContent($data, JSON_UNESCAPED_UNICODE);

        return false;

    }

    /**
     * @param array|object $data
     * @return bool
     */
    public function successJson($data = []): bool {

        $this->response->setStatusCode(200);

        $jsonData = [
            'status'   => 'ok',
            'success'  => true,
            'response' => $data,
        ];

        return $this->sendJson($jsonData);
    }

    public function errorJson($message = null, $errorCode = 0, $statusCode = 400): bool {

        $errorsField = [];

        if($message instanceof \Exception){

            if($message->getCode()){
                $errorCode = $message->getCode();
            }

            $message = $message->getMessage();

        } else if(\is_array($message) && \count($message) > 0 && isset($message[0])){

            if(\count($message) === 2 && \is_int($message[0])){

                [ $errorCode, $message ] = $message;

            } else {

                foreach($message as $msg){
                    if($msg instanceof \Phalcon\Validation\MessageInterface){
                        $errorsField[] = [
                            'name'    => $msg->getField(),
                            'type'    => $msg->getType(),
                            'message' => $msg->getMessage(),
                        ];
                    }
                }

            }
        }

        $errorBlock = [
            'code' => $errorCode,
        ];

        if(\is_array($message) && \count($errorsField) > 0){

            $errorBlock['message'] = 'Some fields are incorrect';
            $errorBlock['fields'] = $errorsField;
            if($errorBlock['code'] === 1) $errorBlock['code'] = 412;
            if($statusCode === 400) $statusCode = 412;

        } else {

            $errorBlock['message'] = $message;

        }

        $jsonData = [
            'status'  => 'error',
            'success' => false,
            'error'   => $errorBlock,
        ];

        $this->response->setStatusCode($statusCode);

        return $this->sendJson($jsonData);
    }

}
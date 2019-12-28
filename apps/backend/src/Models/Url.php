<?php

namespace Backend\Models;

use Backend\Models\Events\CreateUpdateEvents;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Url extends Model {

//    use CreateUpdateEvents;

    public function initialize() {
        $this->addBehavior(new Timestampable([
            'beforeValidationOnCreate' => [
                'field'  => 'created_at',
                'format' => 'Y-m-d H:i:s.u',
            ]
        ]));
    }

    public $id;
    public $url;
    public $code;
    public $created_at;

}
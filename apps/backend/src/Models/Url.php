<?php

namespace Backend\Models;

use Backend\Models\Events\CreateUpdateEvents;
use Phalcon\Mvc\Model;

class Url extends Model
{

    use CreateUpdateEvents;

    public $id;
    public $url;
    public $code;
    public $created_at;

}
<?php

namespace Backend\Models\Events;

use DateTime;
use Phalcon\Mvc\Model\MetaDataInterface;

trait CreateUpdateEvents {

    protected function _preSave(MetaDataInterface $metaData, $exists, $identityField) {

        if($exists) $this->updated_at = self::getNowDateTime();
        else $this->created_at = self::getNowDateTime();

        return parent::_preSave($metaData, $exists, $identityField);

    }

    public static function getNowDateTime() {

        try {

            $dateTime = @DateTime::createFromFormat('U.u', microtime(true));

            if($dateTime){

                $date = $dateTime->format('Y-m-d H:i:s.u');

            } else {

                $date = @date('Y-m-d H:i:s');

            }
        } catch(\Exception $e){

            $date = @date('Y-m-d H:i:s');

        }

        return $date;
    }

}
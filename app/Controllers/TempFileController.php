<?php

namespace Controllers;

use Lib\JSON;
use Models\Model;

class TempFileController
{
    static $temp;

    public static function setTempFiles()
    {
        $emptyArray = [];

        self::$temp = JSON::getJson('dataCars');
        JSON::setJson('dataCars', $emptyArray);
    }

    public static function getTempFiles()
    {
        $emptyArray = [];

        JSON::setJson('dataCars', $emptyArray);
        Model::setCars(self::$temp);
    }
}

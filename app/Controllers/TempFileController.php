<?php

namespace Controllers;

use Lib\JSON;
use Models\Car;

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
        Car::setCars(self::$temp);
    }
}

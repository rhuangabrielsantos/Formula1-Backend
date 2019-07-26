<?php

namespace Controllers;

use Lib\JSON;
use Models\Model;

class TempFileController
{
    static $temp;

    public static function setTempFiles()
    {
        self::$temp = JSON::getJson('dataCars');
        JSON::setJson('dataCars', null);
    }

    public static function getTempFiles()
    {
        JSON::setJson('dataCars', null);
        Model::setJson(self::$temp);
    }
}

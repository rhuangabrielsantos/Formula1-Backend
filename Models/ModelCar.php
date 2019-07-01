<?php

namespace Models;

use Lib\JSON;

class ModelCar
{
    public static function setJson($array)
    {
        JSON::setJson('dataCars', $array);
    }
}

<?php

namespace Models;

use Lib\JSON;

class Car
{
    public static function setCars(array $data)
    {
        JSON::setJson('dataCars', $data);
    }
}

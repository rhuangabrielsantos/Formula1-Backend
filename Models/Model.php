<?php

namespace Models;

use Lib\JSON;

class Model
{
    public static function setJson($array)
    {
        JSON::setJson('dataCars', $array);
    }

    public static function startRace($array)
    {
        JSON::setJson('report', null);
        JSON::setJson('dataRace', $array);
    }

    public static function overtake($array, $report)
    {
        JSON::setJson('dataCars', $array);
        JSON::setJson('report', $report);
    }
}

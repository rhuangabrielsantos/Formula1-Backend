<?php

namespace Models;

use Lib\JSON;

class ModelRace
{
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

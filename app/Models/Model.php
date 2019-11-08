<?php

namespace Models;

use Lib\JSON;

class Model
{
    public static function setCars(array $data)
    {
        JSON::setJson('dataCars', $data);
    }

    public static function startRace()
    {
        $emptyArray = [];
        $start = [
            "Start" => 'on'
        ];

        JSON::setJson('report', $emptyArray);
        JSON::setJson('dataRace', $start);
    }

    public static function overtake($array, $report)
    {
        JSON::setJson('dataCars', $array);
        JSON::setJson('report', $report);
    }

    public static function finishRace()
    {
        $finish = [
            "Start" => 'off'
        ];

        JSON::setJson('dataRace', $finish);
    }
}

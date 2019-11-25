<?php

namespace Models;

use Lib\JSON;

class Race
{
    public static function start()
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

    public static function finish()
    {
        $finish = [
            "Start" => 'off'
        ];

        JSON::setJson('dataRace', $finish);
    }
}

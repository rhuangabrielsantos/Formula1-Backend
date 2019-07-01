<?php

namespace Models;

use Lib\JSON;

class ModelRace
{
    public static function startRace($array)
    {
        ModelRace::newReport();
        ModelRace::setRace($array);
    }

    public static function newReport()
    {
        JSON::setJson('report', null);
    }

    public static function setRace($array)
    {
        JSON::setJson('dataRace', $array);
    }

    public static function addReport($array)
    {
        JSON::setJson('report', $array);
    }

    public static function overtake($array, $report)
    {
        JSON::setJson('dataCars', $array);
        ModelRace::addReport($report);
    }
}

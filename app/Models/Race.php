<?php

namespace Models;

use Lib\JSON;

class Race
{
    public static function setStatusRace($statusRace): void
    {
        JSON::setJson('dataRace', $statusRace);
    }

    public static function overtake($array): void
    {
        JSON::setJson('dataCars', $array);
    }

    public static function setReports($report): void
    {
        JSON::setJson('report', $report);
    }
}

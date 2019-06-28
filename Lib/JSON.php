<?php

namespace Lib;

class JSON
{
    public static function getDataCars()
    {
        return json_decode(file_get_contents(__DIR__ . '/../filesJson/dataCars.json'), true);
    }

    public static function getDataRace()
    {
        return json_decode(file_get_contents(__DIR__ . '/../filesJson/dataRace.json'), true);
    }

    public static function getReport()
    {
        return json_decode(file_get_contents(__DIR__ . '/../filesJson/report.json'), true);
    }
}
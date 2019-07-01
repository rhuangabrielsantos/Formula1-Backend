<?php

namespace Lib;

class JSON
{
    public static function getDataCars()
    {
        return self::getJson('dataCars');
    }

    public static function getDataRace()
    {
        return self::getJson('dataRace');
    }

    public static function getReport()
    {
        return self::getJson('report');
    }

    public static function getGodMode()
    {
        return self::getJson('godMode');
    }

    public static function getJson($file)
    {
        return json_decode(file_get_contents(__DIR__ . '/../filesJson/' . $file . '.json'), true);
    }

    public static function setJson($file, $array)
    {
        $path = __DIR__ . "/../filesJson/" . $file . ".json";
        $json = json_encode($array, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }
}

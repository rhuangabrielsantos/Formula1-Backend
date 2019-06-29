<?php

namespace Models;

use Lib\JSON;

class ModelRace
{
    public $start;
    public $report;
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->start = false;
        $this->dataRace = JSON::getDataRace();
        $this->dataCars = JSON::getDataCars();
        $this->report = JSON::getReport();
    }

    public static function startRace($array)
    {
        ModelRace::newReport();
        ModelRace::setRace($array);
    }

    public static function newReport()
    {
        unlink(__DIR__ . "/../filesJson/report.json");
        $fp = fopen(__DIR__ . "/../filesJson/report.json", "a");
        fclose($fp);
    }

    public static function setRace($array)
    {
        $path = __DIR__ . "/../filesJson/dataRace.json";
        $json = json_encode($array, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }

    public static function addReport($array)
    {
        $path = __DIR__ . "/../filesJson/report.json";
        $json = json_encode($array, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }

    public static function overtake($array, $report)
    {
        $path = __DIR__ . "/../filesJson/dataCars.json";
        $json = json_encode($array, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);

        ModelRace::addReport($report);
    }
}

<?php

namespace Lib;

class Storage
{
    public function getData(string $fileName)
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/' . $fileName . '.json'), true);
    }

    public function getDataCars()
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/dataCars.json'), true);
    }

    public function getStatusRace()
    {
        $dataRace = json_decode(file_get_contents(__DIR__ . '/../../database/dataRace.json'), true);
        return $dataRace['Start'];
    }

    public function getReports()
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/report.json'), true);
    }

    public function setData(string $fileName, array $data)
    {
        $path = __DIR__ . "/../../database/" . $fileName . ".json";
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }

    public function setDataCars(array $data)
    {
        $path = __DIR__ . "/../../database/dataCars.json";
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }

    public function setReports($reports)
    {
        $path = __DIR__ . "/../../database/report.json";
        $json = json_encode($reports, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }

    public function setStatusRace($statusRace)
    {
        $path = __DIR__ . "/../../database/dataRace.json";
        $json = json_encode($statusRace, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }
}
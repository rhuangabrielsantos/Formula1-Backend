<?php

namespace Lib;

class Storage
{
    const CARS_DATA_PATH = __DIR__ . '/../../database/dataCars.json';
    const RACE_DATA_PATH = __DIR__ . '/../../database/dataRace.json';
    const REPORTS_DATA_PATH = __DIR__ . "/../../database/report.json";

    public function getDataCars(): array
    {
        return json_decode(file_get_contents(self::CARS_DATA_PATH), true);
    }

    public function getStatusRace(): string
    {
        $dataRace = json_decode(file_get_contents(self::RACE_DATA_PATH), true);
        return $dataRace['Start'];
    }

    public function getReports(): array
    {
        return json_decode(file_get_contents(self::REPORTS_DATA_PATH), true);
    }

    public function setDataCars(array $data): void
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(self::CARS_DATA_PATH, $json);
    }

    public function setReports(array $reports): void
    {
        $json = json_encode($reports, JSON_PRETTY_PRINT);
        file_put_contents(self::REPORTS_DATA_PATH, $json);
    }

    public function setStatusRace(array $statusRace): void
    {
        $json = json_encode($statusRace, JSON_PRETTY_PRINT);
        file_put_contents(self::RACE_DATA_PATH, $json);
    }

    public function getDataCarsByPilotName($pilotName): array
    {
        $dataCars = $this->getDataCars();

        foreach ($dataCars as $dataCar) {
            if ($dataCar['Piloto'] == $pilotName) {
                return $dataCar;
            }
        }

        return [];
    }
}
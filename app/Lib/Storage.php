<?php

namespace Lib;

class Storage
{
    public function getDataCars(): array
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/dataCars.json'), true);
    }

    public function getStatusRace(): string
    {
        $dataRace = json_decode(file_get_contents(__DIR__ . '/../../database/dataRace.json'), true);
        return $dataRace['Start'];
    }

    public function getReports(): array
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/report.json'), true);
    }

    public function setDataCars(array $data): void
    {
        $path = __DIR__ . "/../../database/dataCars.json";
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }

    public function setReports(array $reports): void
    {
        $path = __DIR__ . "/../../database/report.json";
        $json = json_encode($reports, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }

    public function setStatusRace(array $statusRace): void
    {
        $path = __DIR__ . "/../../database/dataRace.json";
        $json = json_encode($statusRace, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
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
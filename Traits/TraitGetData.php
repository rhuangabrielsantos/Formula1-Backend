<?php

namespace Traits;

use Lib\JSON;

trait TraitGetData
{
    public $godMode;
    public $dataRace;
    public $dataCars;
    public $report;

    public function __construct()
    {
        $this->dataRace = JSON::getDataRace();
        $this->dataCars = JSON::getDataCars();
        $this->report = JSON::getReport();
        $this->godMode = JSON::getGodMode();
    }
}

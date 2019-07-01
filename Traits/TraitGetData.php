<?php

namespace Traits;

use Lib\JSON;

trait TraitGetData
{
    public $dataRace;
    public $dataCars;
    public $report;

    public function getData()
    {
        $this->dataRace = JSON::getDataRace();
        $this->dataCars = JSON::getDataCars();
        $this->report = JSON::getReport();
    }
}

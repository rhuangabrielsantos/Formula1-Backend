<?php

namespace Traits;

use Lib\JSON;

trait TraitGetData
{
    public $dataRace;
    public $dataCars;
    public $report;

    public function __construct()
    {
        $this->dataRace = JSON::getJson('dataRace');
        $this->dataCars = JSON::getJson('dataCars');
        $this->report = JSON::getJson('report');
    }
}

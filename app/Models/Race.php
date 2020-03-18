<?php

namespace Models;

use Lib\StorageFactory;

class Race
{
    public function setStatusRace(StorageFactory $storage, $statusRace): void
    {
        $storage->setData('dataRace', $statusRace);
    }

    public function overtake(StorageFactory $storage, $array): void
    {
        $storage->setData('dataCars', $array);
    }

    public function setReports(StorageFactory $storage, array $reports): void
    {
        $storage->setData('report', $reports);
    }
}

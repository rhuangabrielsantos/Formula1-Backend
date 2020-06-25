<?php

namespace Models;

use Lib\Storage;

class Race
{
    private $storage;

    public function __construct()
    {
        $this->storage = new Storage();
    }

    public function setStatusRace($statusRace): void
    {
        $this->storage->setStatusRace($statusRace);
    }

    public function cleanReports()
    {
        $this->storage->setReports([]);
    }
}

<?php

namespace Commands;

use Controllers\RaceController;
use Lib\StorageFactory;
use Models\Race;
use Views\View;

class FinishRace implements Command
{
    private $dataCars;
    private $statusRace;
    private $storage;

    public function __construct(array $dataCars, string $statusRace, StorageFactory $storage)
    {
        $this->dataCars = $dataCars;
        $this->statusRace = $statusRace;
        $this->storage = $storage;
    }

    public function runCommand()
    {
        $returnedStatusRace = (new RaceController())->finishRace(
            $this->statusRace
        );

        (new Race())->setStatusRace($this->storage, $returnedStatusRace);

        (new View())->podium($this->dataCars);
    }
}
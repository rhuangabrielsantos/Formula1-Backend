<?php

use Commands\FinishRace;
use Controllers\RaceController;
use Helper\Status;
use Lib\Storage;
use PHPUnit\Framework\TestCase;
use Views\View;

class FinishRaceCommandTest extends TestCase
{
    /** @before */
    public function insertingCarsInStorageForTests(): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'off']);
        $storage->setDataCars([
            0 => [
                'Piloto' => 'PilotOne',
                'Marca' => 'AA',
                'Modelo' => 'BB',
                'Cor' => 'Black',
                'Ano' => 1998
            ],
            1 => [
                'Piloto' => 'PilotTwo',
                'Marca' => 'AA',
                'Modelo' => 'BB',
                'Cor' => 'Black',
                'Ano' => 1998
            ]
        ]);
    }

    /** @after */
    public function clearStorage(): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'off']);
        $storage->setDataCars([]);
    }

    /** @test */
    public function givenFinishRaceCommand_withRunningRace_shouldFinishRace(): void
    {
        (new Storage())->setStatusRace(['Start' => 'on']);

        $response = FinishRace::runCommand([]);

        $this->assertEquals(Status::OK, $response['status']);
        $this->assertEquals((new RaceController())->showPodium(), $response['message']);
    }

    /** @test */
    public function givenFinishRaceCommand_withTheRaceStopped_shouldError(): void
    {
        $response = FinishRace::runCommand([]);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals((View::errorMessageNeedStart()), $response['message']);
    }
}

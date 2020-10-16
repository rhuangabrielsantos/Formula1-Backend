<?php

use Commands\DeleteCar;
use Helper\Status;
use Lib\Storage;
use PHPUnit\Framework\TestCase;
use Views\View;

class DeleteCarCommandTest extends TestCase
{
    /** @before */
    public function setRaceStatusToStopped(): void
    {
        (new Storage())->setStatusRace(['Start' => 'off']);
    }

    /** @before */
    public function insertingCarsInStorageForTests(): void
    {
        (new Storage())->setDataCars([
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

    /**  @test */
    public function givenDeleteCarCommand_withAvailableCars_shouldDeletedCar(): void
    {
        $response = DeleteCar::runCommand(['PilotOne']);

        $this->assertEquals(Status::OK, $response['status']);
        $this->assertEquals(View::successMessageDeleteCar(), $response['message']);
    }

    /** @test */
    public function givenDeleteCarCommand_withRunningRace_shouldError(): void
    {
        (new Storage())->setStatusRace(['Start' => 'on']);

        $response = DeleteCar::runCommand(['PilotOne']);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageNewCarRaceStart(), $response['message']);
    }

    /** @test */
    public function givenDeleteCarCommand_withPilotNameIsNull_shouldError(): void
    {
        $response = DeleteCar::runCommand(['']);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageDeleteCar(), $response['message']);
    }

    /** @test */
    public function givenDeleteCarCommand_withPilotNameNotExists_shouldError(): void
    {
        $response = DeleteCar::runCommand(['Invalid']);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessagePilotNameIsInvalid(), $response['message']);
    }
}

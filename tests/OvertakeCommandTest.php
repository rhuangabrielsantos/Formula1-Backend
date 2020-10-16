<?php

use Commands\OvertakeCar;
use Helper\Status;
use Lib\Storage;
use PHPUnit\Framework\TestCase;
use Views\View;

class OvertakeCommandTest extends TestCase
{
    /** @before */
    public function setRaceStatusToRunning(): void
    {
        (new Storage())->setStatusRace(['Start' => 'on']);
    }

    /** @before */
    public function insertingCarsInStorage(): void
    {
        (new Storage())->setDataCars([
            0 => [
                'Piloto' => 'PilotOne',
                'Marca' => 'AA',
                'Modelo' => 'BB',
                'Cor' => 'Black',
                'Ano' => 1998,
                'Posicao' => 1
            ],
            1 => [
                'Piloto' => 'PilotTwo',
                'Marca' => 'AA',
                'Modelo' => 'BB',
                'Cor' => 'Black',
                'Ano' => 1998,
                'Posicao' => 2
            ]
        ]);
    }

    /** @after */
    public function clearStorage(): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'off']);
        $storage->setDataCars([]);
        $storage->setReports([]);
    }

    /** @test */
    public function givenOvertakeCommand_withRunningRace_shouldCarOvertakeOpponent(): void
    {
        $response = OvertakeCar::runCommand(['PilotTwo']);

        $this->assertEquals(Status::OK, $response['status']);
        $this->assertEquals(View::successMessageOvertaking('PilotTwo', 'PilotOne'), $response['message']);
    }

    /** @test */
    public function givenOvertakeCommand_withInvalidPilotName_shouldError(): void
    {
        $response = OvertakeCar::runCommand(['Invalid']);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessagePilotNameIsInvalid(), $response['message']);
    }

    /** @test */
    public function givenOvertakeCommand_withPilotNameNull_shouldError(): void
    {
        $response = OvertakeCar::runCommand(['']);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessagePilotNameIsEmpty(), $response['message']);
    }

    /** @test */
    public function givenOvertakeCommand_withRaceNotStarted_shouldError(): void
    {
        (new Storage())->setStatusRace(['Start' => 'off']);

        $response = OvertakeCar::runCommand(['PilotTwo']);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageNeedStart(), $response['message']);
    }

    /** @test */
    public function givenOvertakeCommand_withPilotFirstPlace_shouldError(): void
    {
        $response = OvertakeCar::runCommand(['PilotOne']);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageOvertakingFirsPlace('PilotOne'), $response['message']);
    }
}

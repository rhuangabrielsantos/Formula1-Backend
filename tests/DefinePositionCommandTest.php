<?php

use Commands\DefinePosition;
use Helper\Status;
use Lib\Storage;
use PHPUnit\Framework\TestCase;
use Views\View;

class DefinePositionCommandTest extends TestCase
{
    /** @before @after */
    public function clearStorage(): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'off']);
        $storage->setDataCars([]);
    }

    public function providerDataCarsWithTwoCars(): array
    {
        return [
            [
                [
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
                ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider providerDataCarsWithTwoCars
     * @param array $dataCars
     */
    public function givenDefinePositionCommand_withCarsWithoutPositions_shouldDefinePosition(array $dataCars): void
    {
        (new Storage())->setDataCars($dataCars);

        $response = DefinePosition::runCommand([]);

        $this->assertEquals(Status::OK, $response['status']);
        $this->assertEquals(View::successMessageSetPosition(), $response['message']);
    }

    /**
     * @test
     * @dataProvider providerDataCarsWithTwoCars
     * @param array $dataCars
     */
    public function givenDefinePositionCommand_withRunningRace_shouldError(array $dataCars): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'on']);
        $storage->setDataCars($dataCars);

        $response = DefinePosition::runCommand([]);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageRaceStarted(), $response['message']);
    }

    /** @test */
    public function givenDefinePositionCommand_withNoCar_shouldError(): void
    {
        $response = DefinePosition::runCommand([]);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageDataCarsEmpty(), $response['message']);
    }
}

<?php

use Commands\NewCar;
use Helper\Status;
use Lib\Storage;
use PHPUnit\Framework\TestCase;
use Views\View;

class NewCarCommandTest extends TestCase
{
    /** @before @after */
    public function clearStorage(): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'off']);
        $storage->setDataCars([]);
    }

    public function providerValidCar(): array
    {
        return [
            [
                ['PilotOne', 'AA', 'BB', 'Black', 1998]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider providerValidCar
     * @param array $dataCar
     */
    public function givenNewCarCommand_withValidCar_shouldCreateCar(array $dataCar): void
    {
        $response = NewCar::runCommand($dataCar);

        $this->assertEquals(Status::CREATED, $response['status']);
        $this->assertEquals(View::successMessageNewCar(), $response['message']);
    }

    public function providerInvalidCar(): array
    {
        return [
            [
                ['PilotOne', 'AA', 'BB', '', 1998]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider providerInvalidCar
     * @param array $dataCar
     */
    public function givenNewCarCommand_withInvalidCar_shouldError(array $dataCar): void
    {
        $response = NewCar::runCommand($dataCar);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageInvalidCar(), $response['message']);
    }

    /**
     * @test
     * @dataProvider providerValidCar
     * @param array $dataCar
     */
    public function givenNewCarCommand_withRaceRunning_shouldError(array $dataCar): void
    {
        (new Storage())->setStatusRace(['Start' => 'on']);

        $response = NewCar::runCommand($dataCar);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageNewCarRaceStart(), $response['message']);
    }

    public function providerCarYearIsString(): array
    {
        return [
            [
                ['PilotOne', 'AA', 'BB', 'asda', 'adas']
            ]
        ];
    }

    /**
     * @test
     * @dataProvider providerCarYearIsString
     * @param array $dataCar
     */
    public function givenNewCarCommand_withCarYearIsString_shouldError(array $dataCar): void
    {
        $response = NewCar::runCommand($dataCar);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageNotInteger(), $response['message']);
    }

    public function providerDataCarsWithTwoCars()
    {
        return [
            [
                [
                    0 => [
                        'Piloto' => 'PilotOne',
                        'Marca' => 'AA',
                        'Modelo' => 'BB',
                        'Cor' => 'Black',
                        'Ano' => 1998,
                        'Posicao' => '1'
                    ],
                    1 => [
                        'Piloto' => 'PilotTwo',
                        'Marca' => 'AA',
                        'Modelo' => 'BB',
                        'Cor' => 'Black',
                        'Ano' => 1998,
                        'Posicao' => '2'
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
    public function givenNewCarCommand_withPilotExists_shouldError(array $dataCars): void
    {
        (new Storage())->setDataCars($dataCars);

        $newCar = ['PilotOne', 'AA', 'BB', 'Black', 1998];

        $response = NewCar::runCommand($newCar);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals(View::errorMessageNewCarExistPilot(), $response['message']);
    }
}

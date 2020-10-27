<?php

use Commands\StartRace;
use Helper\Status;
use Lib\Storage;
use PHPUnit\Framework\TestCase;
use Views\View;

class StartRaceCommandTest extends TestCase
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
    public function givenStartRaceCommand_withDefinedCars_shouldRaceStarted(array $dataCars): void
    {
        (new Storage())->setDataCars($dataCars);

        $response = StartRace::runCommand([]);

        $this->assertEquals(Status::OK, $response['status']);
        $this->assertEquals((View::successMessageStartRace()), $response['message']);
    }

    /**
     * @test
     * @dataProvider providerDataCarsWithTwoCars
     * @param array $dataCars
     */
    public function givenStartRaceCommand_withARaceAlreadyStarted_shouldError(array $dataCars): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'on']);
        $storage->setDataCars($dataCars);

        $response = StartRace::runCommand([]);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals((View::errorMessageStartAgain()), $response['message']);
    }

    /** @test */
    public function givenStartRaceCommand_withDataCarsEmpty_shouldError(): void
    {
        $response = StartRace::runCommand([]);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals((View::errorMessageDataCarsEmpty()), $response['message']);
    }

    public function providerSingleCar(): array
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
                    ]
                ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider providerSingleCar
     * @param array $dataCars
     */
    public function givenStartRaceCommand_withSingleCar_shouldError(array $dataCars): void
    {
        (new Storage())->setDataCars($dataCars);

        $response = StartRace::runCommand([]);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals((View::errorMessageOneCarImpossibleRace()), $response['message']);
    }

    public function providerDataCarsWithTwoCarsNotDefinedPosition(): array
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
                    ],
                    1 => [
                        'Piloto' => 'PilotTwo',
                        'Marca' => 'AA',
                        'Modelo' => 'BB',
                        'Cor' => 'Black',
                        'Ano' => 1998,
                    ]
                ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider providerDataCarsWithTwoCarsNotDefinedPosition
     * @param array $dataCars
     */
    public function givenStartRaceCommand_withTwoCarsNotDefinedPosition_shouldError(array $dataCars): void
    {
        (new Storage())->setDataCars($dataCars);

        $response = StartRace::runCommand([]);

        $this->assertEquals(Status::ERROR, $response['status']);
        $this->assertEquals((View::errorMessageNeedDefinePosition()), $response['message']);
    }
}

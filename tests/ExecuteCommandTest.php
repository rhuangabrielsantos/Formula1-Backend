<?php

use Commands\ExecuteCommand;
use Lib\Storage;
use PHPUnit\Framework\TestCase;

class ExecuteCommandTest extends TestCase
{
    /** @before @after */
    public function clearStorage(): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'off']);
        $storage->setDataCars([]);
    }

    public function provideCarsWithNotPositions(): array
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
     * @dataProvider provideCarsWithNotPositions
     * @param array $dataCars
     */
    public function givenDefinePositionCommand_shouldPositionsHaveBeenDefined(array $dataCars): void
    {
        $storage = new Storage();
        $storage->setDataCars($dataCars);

        (new ExecuteCommand())->run('definirPosicoes', []);

        $registeredCars = $storage->getDataCars();
        $this->assertEquals(1, $registeredCars[0]['Posicao']);
    }

    /**
     * @test
     * @dataProvider provideCarsWithNotPositions
     * @param array $dataCars
     */
    public function givenDeleteCarCommand_shouldCarIsExcluded(array $dataCars): void
    {
        $storage = new Storage();
        $storage->setDataCars($dataCars);

        $registeredCars = $storage->getDataCars();
        $this->assertCount(2, $registeredCars);

        (new ExecuteCommand())->run('excluirCarro', ['PilotOne']);

        $registeredCars = $storage->getDataCars();
        $this->assertCount(1, $registeredCars);
    }

    /** @test */
    public function givenNewCarCommand_shouldCarIsCreated(): void
    {
        $storage = new Storage();

        $registeredCars = $storage->getDataCars();
        $this->assertCount(0, $registeredCars);

        (new ExecuteCommand())->run('adicionarCarro', ['PilotOne', 'AA', 'BB', 'Black', 1998]);

        $registeredCars = $storage->getDataCars();
        $this->assertCount(1, $registeredCars);
    }

    public function provideCarsWithPositions(): array
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
                ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider provideCarsWithPositions
     * @param array $dataCars
     */
    public function givenStartRaceCommand_shouldRaceIsStarted(array $dataCars): void
    {
        $storage = new Storage();
        $storage->setDataCars($dataCars);

        $statusRace = $storage->getStatusRace();
        $this->assertEquals('off', $statusRace);

        (new ExecuteCommand())->run('iniciarCorrida', []);

        $statusRace = $storage->getStatusRace();
        $this->assertEquals('on', $statusRace);
    }

    /**
     * @test
     * @dataProvider provideCarsWithPositions
     * @param array $dataCars
     */
    public function givenFinishRaceCommand_shouldRaceIsFinished(array $dataCars): void
    {
        $storage = new Storage();
        $storage->setStatusRace(['Start' => 'on']);
        $storage->setDataCars($dataCars);

        $statusRace = $storage->getStatusRace();
        $this->assertEquals('on', $statusRace);

        (new ExecuteCommand())->run('finalizarCorrida', []);

        $statusRace = $storage->getStatusRace();
        $this->assertEquals('off', $statusRace);
    }

    /**
     * @test
     * @dataProvider provideCarsWithPositions
     * @param array $dataCars
     */
    public function givenOvertakeCommand_shouldCarOvertaken(array $dataCars): void
    {
        $storage = new Storage();
        $storage->setDataCars($dataCars);
        $storage->setStatusRace(['Start' => 'on']);

        $registeredCars = $storage->getDataCars();
        $this->assertEquals('PilotOne', $registeredCars[0]['Piloto']);

        (new ExecuteCommand())->run('ultrapassar', ['PilotTwo']);

        $registeredCars = $storage->getDataCars();
        $this->assertEquals('PilotTwo', $registeredCars[0]['Piloto']);
    }
}

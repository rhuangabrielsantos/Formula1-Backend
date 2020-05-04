<?php

use Controllers\RaceController;
use Lib\JSON;
use Lib\StorageFactory;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public $dataCars;

    public static function testStartRace(): void
    {
        $raceController = new RaceController();
        $returnedStatus = $raceController->startRace();

        $exceptedStatus = ['Start' => 'on'];

        Assert::assertEquals($exceptedStatus, $returnedStatus);
    }

    public static function testFinishRace(): void
    {
        $raceController = new RaceController();
        $returnedStatus = $raceController->finishRace();

        $exceptedStatus = ['Start' => 'off'];

        Assert::assertEquals($exceptedStatus, $returnedStatus);
    }

    /**
     * @dataProvider providerCarsForRaceTests
     * @param array $cars
     */
    public static function testOvertake($cars): void
    {
        ob_start();

        Assert::assertEquals('PilotOne', $cars[0]['Piloto']);

        $raceController = new RaceController();
        $returnedCars = $raceController->overtake('PilotTwo', $cars, []);
        (new StorageFactory(new JSON()))->setData('report', []);

        Assert::assertEquals('PilotTwo', $returnedCars[0][0]['Piloto']);
        ob_end_clean();
    }

    public function providerCarsForRaceTests(): array
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
}

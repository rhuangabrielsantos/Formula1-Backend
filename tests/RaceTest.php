<?php

use Controllers\RaceController;
use Models\Race;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public $dataCars;

    /**
     * @dataProvider providerCarsForRaceTests
     * @param array $cars
     */
    public static function testStartRace($cars): void
    {
        $raceController = new RaceController();
        $returnedStatus = $raceController->startRace('off', $cars);

        $exceptedStatus = ['Start' => 'on'];

        Assert::assertEquals($exceptedStatus, $returnedStatus);
    }

    /**
     * @dataProvider providerCarsForRaceTests
     * @param array $cars
     */
    public static function testFinishRace($cars): void
    {
        $raceController = new RaceController();
        $returnedStatus = $raceController->finishRace('on', $cars);

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
        $input = ['executarComando', 'overtake', 'PilotTwo'];

        Assert::assertEquals('PilotOne', $cars[0]['Piloto']);

        $raceController = new RaceController();
        $returnedCars = $raceController->overtake($input, 'on', $cars, []);
        Race::setReports([]);

        Assert::assertEquals('PilotTwo', $returnedCars[0]['Piloto']);
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

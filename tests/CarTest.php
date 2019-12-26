<?php

require __DIR__ . "/../vendor/autoload.php";

use Controllers\CarController;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    /**
     * @dataProvider providerCarsForNewCarTests
     * @param array $newCars
     */
    public static function testIfTheReturnedCarIsValid(array $newCars): void
    {
        $emptyDataCars = [];

        $carExpected = [
            0 => [
                'Piloto' => 'PilotOne',
                'Marca' => 'AA',
                'Modelo' => 'BB',
                'Cor' => 'Black',
                'Ano' => 1998
            ]
        ];

        $carController = new CarController();
        $returnedCard = $carController->newCar($newCars, $emptyDataCars, 'off');

        Assert::assertEquals($carExpected, $returnedCard);
    }

    /**
     * @dataProvider providerCarsForNewCarTests
     * @param array $newCars
     */
    public function testIfTheYearOfCarIsInteger(array $newCars)
    {
        $emptyDataCars = [];

        $carController = new CarController();
        $returnedCars = $carController->newCar($newCars, $emptyDataCars, 'off');

        Assert::assertIsInt($returnedCars[0]['Ano']);
    }

    /**
     * @dataProvider providerCarsForDeleteCarTests
     * @param array $dataCars
     */
    public function testDeleteCar(array $dataCars): void
    {
        $inputCommand = ['PilotOne'];

        $carController = new CarController();
        $returnedCars = $carController->deleteCar($inputCommand, $dataCars, 'off');

        Assert::assertEmpty($returnedCars);
    }

    /**
     * @dataProvider providerCarsForSetPositionTests
     * @param array $cars
     */
    public function testSetPositionWithTwoCars(array $cars): void
    {
        $carController = new CarController();
        $returnedCars = $carController->setPosition($cars, 'off');

        Assert::assertEquals('1', $returnedCars[0]['Posicao']);
        Assert::assertEquals('2', $returnedCars[1]['Posicao']);
    }

    /**
     * @dataProvider providerCarsForTestDeleteCarsAfterDefinePositions
     * @param array $cars
     */
    public function testDeleteCarsAfterDefinePositions(array $cars): void
    {
        $inputCommand = ['PilotOne'];

        $carController = new CarController();
        $returnedCars = $carController->deleteCar($inputCommand, $cars, 'off');

        Assert::assertEquals('PilotTwo', $returnedCars[0]['Piloto']);
        Assert::assertEquals('1', $returnedCars[0]['Posicao']);
    }

    public function providerCarsForNewCarTests(): array
    {
        return [
            [
                ['PilotOne', 'AA', 'BB', 'Black', 1998]
            ]
        ];
    }

    public function providerCarsForDeleteCarTests(): array
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

    public function providerCarsForSetPositionTests()
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
                        'Ano' => 2000
                    ]
                ]
            ]
        ];
    }

    public function providerCarsForTestDeleteCarsAfterDefinePositions()
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

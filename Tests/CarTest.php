<?php

require __DIR__ . "/../vendor/autoload.php";

use Controllers\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testNewCar()
    {
        $expected = [
            'Piloto' => 'AA',
            'Marca' => 'AA',
            'Modelo' => 'AA',
            'Cor' => 'AA',
            'Ano' => '1234'
        ];

        $car = new Car();
        $test = $car->newCar('AA', 'AA', 'AA', 'AA', '1234');

        $this->assertEquals($expected, $test);
    }

    public function testStartRace()
    {
        $expected = true;

        $car = new Car();
        $car->newCar('AA', 'AA', 'AA', 'AA', '1234');
        $car->setPosition();
        $test = $car->startRace();

        $this->assertEquals($expected, $test);
    }

    public function testShowCars()
    {
        $expected = true;

        $car = new Car();
        $car->newCar('AA', 'AA', 'AA', 'AA', '1234');
        $test = $car->showCars();

        $this->assertEquals($expected, $test);
    }

    public function testOvertake()
    {
        $expected = true;

        $car = new Car();
        $car->newCar('AA1', 'AA', 'AA', 'AA', '1234');
        $car->newCar('AA2', 'AA', 'AA', 'AA', '1234');
        $car->setPosition();

        $car->startRace();
        $test = $car->overtake('AA2', 'AA1');

        $this->assertEquals($expected, $test);
    }

    public function testFinishRace()
    {
        $expected = true;

        $car = new Car();
        $car->newCar('AA1', 'AA', 'AA', 'AA', '1234');
        $car->newCar('AA2', 'AA', 'AA', 'AA', '1234');
        $car->setPosition();

        $car->startRace();
        $test = $car->finishRace();

        $this->assertEquals($expected, $test);
    }

    public function testReport()
    {
        $expected = true;

        $car = new Car();
        $car->newCar('AA1', 'AA', 'AA', 'AA', '1234');
        $car->newCar('AA2', 'AA', 'AA', 'AA', '1234');
        $car->setPosition();

        $car->startRace();
        $car->overtake('AA2', 'AA1');
        $car->finishRace();
        $test = $car->report();

        $this->assertEquals($expected, $test);
    }
}

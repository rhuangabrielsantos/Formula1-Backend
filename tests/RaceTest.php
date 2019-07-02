<?php

use Controllers\ControllerCar;
use Controllers\ControllerRace;
use Lib\JSON;
use PHPUnit\Framework\TestCase;
use View\View;

class RaceTest extends TestCase
{
    public $godMode;

    public function testStartRace()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode['Status'] == true) {

            $car = new ControllerCar();
            $car->newCar('Rhuan', 'Ferrari', '450', 'Red', '2018');
            $car->newCar('Eloah', 'Ferrari', '450', 'Red', '2018');
            $car->setPosition();

            $start = JSON::getDataRace();
            $this->assertEquals(false, $start['Start']);

            $race = new ControllerRace();
            $race->startRace();

            $start = JSON::getDataRace();
            $this->assertEquals(true, $start['Start']);

        } else {
            View::errorMessageTests();
            exit;
        }
    }

    public function testOvertake()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode['Status'] == true) {

            $cars = JSON::getDataCars();
            $this->assertEquals('Rhuan', $cars[0]['Piloto']);

            $race = new ControllerRace();
            $race->overtake('Eloah');

            $cars = JSON::getDataCars();
            $this->assertEquals('Eloah', $cars[0]['Piloto']);

        } else {
            View::errorMessageTests();
            exit;
        }
    }

    public function testFinishRace()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode['Status'] == true) {

            $race = new ControllerRace();
            $race->finishRace();

            $start = JSON::getDataRace();
            $this->assertEquals(false, $start['Start']);

            $empty = null;

            JSON:: setJson('report', $empty);
            JSON::setJson('dataCars', $empty);
        } else {
            View::errorMessageTests();
            exit;
        }
    }
}

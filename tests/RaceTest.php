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
            ob_start();
            $car = new ControllerCar();
            $car->newCar('TestePilotoUm', 'Ferrari', '450', 'Red', '2018');
            $car->newCar('TestePilotoDois', 'Ferrari', '450', 'Red', '2018');
            $car->setPosition();

            $start = JSON::getDataRace();
            $this->assertEquals(false, $start['Start']);

            $race = new ControllerRace();
            $race->startRace();

            $start = JSON::getDataRace();
            $this->assertEquals(true, $start['Start']);
            ob_end_clean();
        } else {
            View::errorMessageTests();
            exit;
        }
    }

    public function testOvertake()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode['Status'] == true) {
            ob_start();
            $cars = JSON::getDataCars();
            $this->assertEquals('TestePilotoUm', $cars[0]['Piloto']);

            $race = new ControllerRace();
            $race->overtake('TestePilotoDois');

            $cars = JSON::getDataCars();
            $this->assertEquals('TestePilotoDois', $cars[0]['Piloto']);
            ob_end_clean();
        } else {
            View::errorMessageTests();
            exit;
        }
    }

    public function testFinishRace()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode['Status'] == true) {
            ob_start();
            $race = new ControllerRace();
            $race->finishRace();

            $start = JSON::getDataRace();
            $this->assertEquals(false, $start['Start']);

            $empty = null;

            JSON:: setJson('report', $empty);
            JSON::setJson('dataCars', $empty);
            ob_end_clean();
        } else {
            View::errorMessageTests();
            exit;
        }
    }
}

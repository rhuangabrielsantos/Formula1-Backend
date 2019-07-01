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
            $empty = $car->dataCars;
            $car->newCar('Rhuan', 'Ferrari', '450', 'Red', '2018');
            $car->newCar('Eloah', 'Ferrari', '450', 'Red', '2018');
            $car->setPosition();

            $start = JSON::getDataRace();
            $this->assertEquals(false, $start['Start']);

            $race = new ControllerRace();
            $race->startRace();

            $start = JSON::getDataRace();
            $this->assertEquals(true, $start['Start']);

            JSON::setJson('dataCars', $empty);
        } else {
            View::errorMessageTests();
            exit;
        }
    }

    public function testFinishRace()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode['Status'] == true) {

            $car = new ControllerRace();
            $car->finishRace();

            $start = JSON::getDataRace();
            $this->assertEquals(false, $start['Start']);
        } else {
            View::errorMessageTests();
            exit;
        }
    }
}

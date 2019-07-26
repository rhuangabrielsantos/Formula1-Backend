<?php

use Controllers\ControllerCar;
use Controllers\ControllerRace;
use Lib\JSON;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public $dataCars;

    public function testStartRace()
    {
        ob_start();
        $car = new ControllerCar();
        $car->newCar('TestePilotoUm', 'Ferrari', '450', 'Red', '2018');
        $car->newCar('TestePilotoDois', 'Mercedes', '500', 'Black', '2018');
        $car->setPosition(false);

        $start = JSON::getJson('dataRace');
        $this->assertEquals(false, $start['Start']);

        $race = new ControllerRace();
        $race->startRace();

        $start = JSON::getJson('dataRace');
        $this->assertEquals(true, $start['Start']);
        ob_end_clean();
    }

    public function testOvertake()
    {
        ob_start();
        $this->dataCars = JSON::getJson('dataCars');
        $this->assertEquals('TestePilotoUm', $this->dataCars[0]['Piloto']);

        $race = new ControllerRace();
        $race->overtake('TestePilotoDois');

        $this->dataCars = JSON::getJson('dataCars');
        $this->assertEquals('TestePilotoDois', $this->dataCars[0]['Piloto']);
        ob_end_clean();
    }

    public function testFinishRace()
    {
        ob_start();
        $race = new ControllerRace();
        $race->finishRace();

        $start = JSON::getJson('dataRace');
        $this->assertEquals(false, $start['Start']);

        $empty = null;

        JSON:: setJson('report', $empty);
        JSON::setJson('dataCars', $empty);
        ob_end_clean();
    }
}

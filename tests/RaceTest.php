<?php

use Controllers\CarController;
use Controllers\RaceController;
use Controllers\TempFileController;
use Lib\JSON;
use PHPUnit\Framework\TestCase;

class RaceTest extends TestCase
{
    public $dataCars;

    public function testStartRace()
    {
        ob_start();
        TempFileController::setTempFiles();

        $car = new CarController();
        $car->newCar('TestePilotoUm', 'Ferrari', '450', 'Red', '2018');
        $car->newCar('TestePilotoDois', 'Mercedes', '500', 'Black', '2018');
        $car->setPosition(false);

        $start = JSON::getJson('dataRace');
        $this->assertEquals('off', $start['Start']);

        $race = new RaceController();
        $race->startRace();

        $start = JSON::getJson('dataRace');
        $this->assertEquals('on', $start['Start']);
        ob_end_clean();
    }

    public function testOvertake()
    {
        ob_start();
        $this->dataCars = JSON::getJson('dataCars');
        $this->assertEquals('TestePilotoUm', $this->dataCars[0]['Piloto']);

        $race = new RaceController();
        $race->overtake('TestePilotoDois');

        $this->dataCars = JSON::getJson('dataCars');
        $this->assertEquals('TestePilotoDois', $this->dataCars[0]['Piloto']);
        ob_end_clean();
    }

    public function testFinishRace()
    {
        ob_start();
        $race = new RaceController();
        $race->finishRace();

        $start = JSON::getJson('dataRace');
        $this->assertEquals('off', $start['Start']);

        $empty = [];

        JSON:: setJson('report', $empty);
        TempFileController::getTempFiles();
        ob_end_clean();
    }
}

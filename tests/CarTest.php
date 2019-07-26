<?php

require __DIR__ . "/../vendor/autoload.php";

use Controllers\CarController;
use Lib\JSON;
use PHPUnit\Framework\TestCase;
use Controllers\TempFileController;

class CarTest extends TestCase
{
    public $dataCars;

    public function testNewCar()
    {
        ob_start();
        TempFileController::setTempFiles();

        $car = new CarController();
        $car->newCar('TestePilotoUm', 'Ferrari', '450', 'Red', '2018');
        $car->newCar('TestePilotoDois', 'Mercedes', '500', 'Black', '2018');

        $this->dataCars = JSON::getJson('dataCars');

        $this->assertEquals(2, count($this->dataCars));

        $this->assertEquals('TestePilotoUm', $this->dataCars[0]['Piloto']);
        $this->assertEquals('Ferrari', $this->dataCars[0]['Marca']);
        $this->assertEquals('450', $this->dataCars[0]['Modelo']);
        $this->assertEquals('Red', $this->dataCars[0]['Cor']);
        $this->assertEquals('2018', $this->dataCars[0]['Ano']);

        $this->assertEquals('TestePilotoDois', $this->dataCars[1]['Piloto']);
        $this->assertEquals('Mercedes', $this->dataCars[1]['Marca']);
        $this->assertEquals('500', $this->dataCars[1]['Modelo']);
        $this->assertEquals('Black', $this->dataCars[1]['Cor']);
        $this->assertEquals('2018', $this->dataCars[1]['Ano']);

        TempFileController::getTempFiles();
        ob_end_clean();
    }

    public function testDeleteCar()
    {
        ob_start();
        TempFileController::setTempFiles();

        $car = new CarController();
        $car->newCar('TestePilotoUm', 'Ferrari', '450', 'Red', '2018');

        $this->dataCars = JSON::getJson('dataCars');

        $this->assertEquals(1, count($this->dataCars));
        $this->assertEquals('TestePilotoUm', $this->dataCars[0]['Piloto']);

        $car->deleteCar('TestePilotoUm');

        $this->dataCars = JSON::getJson('dataCars');

        $this->assertEquals(0, count($this->dataCars));

        TempFileController::getTempFiles();
        ob_end_clean();
    }

    public function testSetPosition()
    {
        ob_start();
        TempFileController::setTempFiles();

        $car = new CarController();
        $car->newCar('TestePilotoUm', 'Ferrari', '450', 'Red', '2018');

        $this->dataCars = JSON::getJson('dataCars');

        $this->assertEquals(1, count($this->dataCars));

        $car->setPosition();

        $this->dataCars = JSON::getJson('dataCars');

        $this->assertEquals('1', $this->dataCars[0]['Posicao']);

        TempFileController::getTempFiles();
        ob_end_clean();
    }
}

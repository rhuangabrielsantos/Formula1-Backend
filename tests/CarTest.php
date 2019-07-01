<?php

require __DIR__ . "/../vendor/autoload.php";

use Lib\JSON;
use Models\ModelCar;
use PHPUnit\Framework\TestCase;
use Controllers\ControllerCar;

class CarTest extends TestCase
{
    public $dataCars;
    public $godMode;

    public function testNewCar()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode == true) {

            $car = new ControllerCar();
            $car->newCar('Rhuan', 'Ferrari', '450', 'Red', '2018');
            $car->newCar('Eloah', 'Mercedes', '500', 'Black', '2018');

            $this->dataCars = JSON::getDataCars();

            $this->assertEquals(2, count($this->dataCars));

            $this->assertEquals('Rhuan', $this->dataCars[0]['Piloto']);
            $this->assertEquals('Ferrari', $this->dataCars[0]['Marca']);
            $this->assertEquals('450', $this->dataCars[0]['Modelo']);
            $this->assertEquals('Red', $this->dataCars[0]['Cor']);
            $this->assertEquals('2018', $this->dataCars[0]['Ano']);

            $this->assertEquals('Eloah', $this->dataCars[1]['Piloto']);
            $this->assertEquals('Mercedes', $this->dataCars[1]['Marca']);
            $this->assertEquals('500', $this->dataCars[1]['Modelo']);
            $this->assertEquals('Black', $this->dataCars[1]['Cor']);
            $this->assertEquals('2018', $this->dataCars[1]['Ano']);

            unset($this->dataCars[0]);
            unset($this->dataCars[1]);
            ModelCar::setJson($this->dataCars);
        }
    }

    public function testDeleteCar()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode == true) {
            $car = new ControllerCar();
            $car->newCar('Rhuan', 'Ferrari', '450', 'Red', '2018');

            $this->dataCars = JSON::getDataCars();

            $this->assertEquals(1, count($this->dataCars));
            $this->assertEquals('Rhuan', $this->dataCars[0]['Piloto']);

            $car->deleteCar('Rhuan');

            $this->dataCars = JSON::getDataCars();

            $this->assertEquals(0, count($this->dataCars));
        }
    }

    public function testSetPosition()
    {
        $this->godMode = JSON::getGodMode();

        if ($this->godMode == true) {
            $car = new ControllerCar();
            $car->newCar('Rhuan', 'Ferrari', '450', 'Red', '2018');

            $this->dataCars = JSON::getDataCars();

            $this->assertEquals(1, count($this->dataCars));
            $this->assertEquals(null, $this->dataCars[0]['Posicao']);

            $car->setPosition();

            $this->dataCars = JSON::getDataCars();

            $this->assertEquals('1', $this->dataCars[0]['Posicao']);

            unset($this->dataCars[0]);
            ModelCar::setJson($this->dataCars);
        }
    }
}

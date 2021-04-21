<?php

namespace Api\Controllers;

use Api\Entities\Car;
use Api\Entities\Report;
use Api\Messages\RaceMessages;
use Api\Repository\CarRepository;
use Api\Repository\ReportRepository;
use Doctrine\ORM\ORMException;

final class RaceController
{
    /**
     * @param string $racingDriverName
     * @return string
     *
     * @throws ORMException
     */
    public function overtake(string $racingDriverName): string
    {
        $carRepository = new CarRepository();
        $dataCars = $carRepository->findAll();
        $carLost = null;

        /** @var Car $car */
        foreach ($dataCars as $car) {
            if ($car->getRacingDriver() == $racingDriverName) {
                $carLost = $carRepository->findByPosition($car->getPosition() - 1);
                $carLost->setPosition($carLost->getPosition() + 1);

                $car->setPosition($car->getPosition() - 1);

                $carRepository->update($carLost);
                $carRepository->update($car);
            }
        }

        $record = $racingDriverName . " ultrapassou " . $carLost->getRacingDriver() . "!" . PHP_EOL;

        (new ReportRepository())->create((new Report())->setRecord($record));

        return $carLost->getRacingDriver();
    }

    /**
     * @return string
     */
    public static function showPodium(): string
    {
        return RaceMessages::podium((new CarRepository())->findAll());
    }
}

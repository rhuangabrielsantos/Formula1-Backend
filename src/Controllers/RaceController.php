<?php

namespace Api\Controllers;

use Api\Entities\Car;
use Api\Entities\Report;
use Api\Enum\StatusEnum;
use Api\Messages\RaceMessages;
use Api\Repository\CarRepository;
use Api\Repository\ReportRepository;
use Api\Repository\StatusRaceRepository;
use Core\Controller\ControllerResponse;
use Doctrine\ORM\ORMException;

final class RaceController
{
    /**
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function startRace(): ControllerResponse
    {
        (new StatusRaceRepository())->setStartRace();

        return (new ControllerResponse(StatusEnum::OK, 'Race was been started'));
    }
    /**
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function finishRace(): ControllerResponse
    {
        (new StatusRaceRepository())->setFinishRace();

        return (new ControllerResponse(StatusEnum::OK, 'Race was been finished'));
    }

    /**
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function getStatusRace(): ControllerResponse
    {
        return (new ControllerResponse(StatusEnum::OK, (new StatusRaceRepository())->get()));
    }

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

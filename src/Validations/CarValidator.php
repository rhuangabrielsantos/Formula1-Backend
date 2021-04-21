<?php

namespace Api\Validations;

use Api\Entities\Car;
use Api\Enum\StatusEnum;
use Api\Messages\CarMessages;
use Api\Messages\RaceMessages;
use Api\Messages\RacingDriverMessages;
use Api\Repository\CarRepository;
use Exception;

final class CarValidator
{
    /**
     * @param array $cars
     *
     * @throws Exception
     */
    public static function thereAreCars(array $cars): void
    {
        if (empty($cars)) {
            throw new Exception(CarMessages::errorMessage_ThereAreNoCars(), StatusEnum::ERROR);
        }
    }

    /**
     * @param string $racingDriverName
     *
     * @throws Exception
     */
    public static function racingDriverNameIsNull(string $racingDriverName)
    {
        if (empty($racingDriverName)) {
            throw new Exception(RacingDriverMessages::errorMessage_NameIsNull());
        }
    }

    /**
     * @param string $racingDriverName
     *
     * @throws Exception
     */
    public static function racingDriverNotExists(string $racingDriverName)
    {
        $car = (new CarRepository())->findByName($racingDriverName);

        if (empty($car)) {
            throw new Exception(RacingDriverMessages::errorMessage_NameIsInvalid());
        }
    }

    /**
     * @param string|null $racingDriverName
     * @param array $dataCars
     *
     * @throws Exception
     */
    public static function racingDriverExists(array $dataCars, ?string $racingDriverName)
    {
        /** @var Car $dataCar */
        foreach ($dataCars as $dataCar) {
            if ($racingDriverName == $dataCar->getRacingDriver()) {
                throw new Exception(RacingDriverMessages::errorMessage_RacingDriverAlreadyExists());
            }
        }
    }

    /**
     * @param array $dataCars
     *
     * @throws Exception
     */
    public static function existsMoreOneCar(array $dataCars)
    {
        if (count($dataCars) === 1) {
            throw new Exception(RaceMessages::errorMessage_ImpossibleToStartTheRaceWithJustOneCar());
        }
    }

    /**
     * @param array $dataCars
     *
     * @throws Exception
     */
    public static function positionsAreSet(array $dataCars)
    {
        /** @var Car $car */
        foreach ($dataCars as $car) {
            if (empty($car->getPosition())) {
                throw new Exception(RaceMessages::errorMessage_ImpossibleToStartTheRaceWithPositionNotDefined());
            }
        }
    }
}

<?php

namespace Helper;

use Views\View;

class FormatEntry
{
    const COMMAND = 1;

    const PILOT = 2;
    const MARK = 3;
    const MODEL = 4;
    const COLOR = 5;
    const YEAR = 6;

    const FIRST_PILOT = 2;
    const SECOND_PILOT = 3;

    public static function returnNewCars(array $inputArguments): array
    {
        Validation::paramsAreValid($inputArguments);

        return [
            $inputArguments[self::PILOT],
            $inputArguments[self::MARK],
            $inputArguments[self::MODEL],
            $inputArguments[self::COLOR],
            self::returnYearFormatted($inputArguments[self::YEAR]),
        ];
    }

    public static function returnCommand(array $inputArguments): string
    {
        return $inputArguments[self::COMMAND];
    }

    private static function returnYearFormatted($year): int
    {
        Validation::yearIsValid($year);

        return $year;
    }

    public static function returnDeleteCar(array $arguments): array
    {
        return [$arguments(self::PILOT)];
    }

    public static function returnOvertakeCars(array $arguments): array
    {
        return [$arguments(self::FIRST_PILOT), $arguments(self::SECOND_PILOT)];
    }
}
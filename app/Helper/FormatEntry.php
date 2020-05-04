<?php

namespace Helper;

use Exception;
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

    public function returnNewCars(array $inputArguments): array
    {
        return [
            $inputArguments[self::PILOT],
            $inputArguments[self::MARK],
            $inputArguments[self::MODEL],
            $inputArguments[self::COLOR],
            self::returnYearFormatted($inputArguments[self::YEAR]),
        ];
    }

    public function returnCommand(?array $inputArguments): ?string
    {
        return $inputArguments[self::COMMAND];
    }

    private function returnYearFormatted($year): int
    {
        $validation = new Validation();
        $validation->yearIsValid($year);

        return $year;
    }

    public function returnPilotName(array $arguments): ?string
    {
        return $arguments[self::PILOT];
    }

    public function returnPilotNameForOvertakeCars(array $arguments): string
    {
        if (!empty($arguments[self::FIRST_PILOT])) {
            return $arguments[self::FIRST_PILOT];
        }
        throw new Exception(View::errorMessagePilotNameIsEmpty());
    }
}
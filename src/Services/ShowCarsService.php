<?php

namespace Api\Services;

use Api\Controllers\CarController;
use Api\Enum\StatusEnum;
use Api\Messages\CarMessages;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;
use Exception;

final class ShowCarsService implements ServiceInterface
{

    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     *
     * @throws Exception
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        $response = (new CarController())->index();

        $carsList = '';

        foreach ($response->getParams() as $car) {
            $carsList .= CarMessages::showCar($car);
        }

        return new CommandResponse(StatusEnum::OK, $carsList);
    }
}

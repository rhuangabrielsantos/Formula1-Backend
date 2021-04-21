<?php

namespace Api\Controllers;

use Api\Enum\StatusEnum;
use Core\Controller\ControllerResponse;

final class AliveController
{
    /**
     * @return \Core\Controller\ControllerResponse
     */
    public function index(): ControllerResponse
    {
        return (new ControllerResponse(StatusEnum::OK, 'Is Alive'));
    }
}

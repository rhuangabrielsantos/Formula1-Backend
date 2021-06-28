<?php

namespace Core\Router\RequestMethods;

use Core\Controller\ControllerResponse;

interface RequestMethodHandler
{
    public function exec(string $requestMethod, array $requestURI, array $controllerReference, ?array $requestArguments): ControllerResponse;

    public function setNextRequestMethodHandler(?RequestMethodHandler $nextRequestMethodHandler): RequestMethodHandler;
}

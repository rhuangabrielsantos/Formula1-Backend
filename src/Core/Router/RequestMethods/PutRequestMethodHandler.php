<?php

namespace Core\Router\RequestMethods;

use Core\Controller\ControllerResponse;
use Exception;
use ReflectionException;
use ReflectionMethod;

final class PutRequestMethodHandler implements RequestMethodHandler
{
    const REQUEST_METHOD = 'PUT';

    private ?RequestMethodHandler $nextRequestMethodHandler;

    /**
     * @param string $requestMethod
     * @param array $requestURI
     * @param array $controllerReference
     * @param array|null $requestArguments
     *
     * @return ControllerResponse
     * @throws ReflectionException
     * @throws Exception
     */
    public function exec(string $requestMethod, array $requestURI, array $controllerReference, ?array $requestArguments): ControllerResponse
    {
        if (self::canHandleRequestMethod($requestMethod)) {
            $arguments = [intval($requestURI['id']), $requestArguments];

            $reflectedController = new ReflectionMethod(
                $controllerReference['namespace'],
                $controllerReference['method']
            );

            return $reflectedController->invokeArgs(new $controllerReference['namespace'], $arguments);
        }

        if ($this->hasNextRequestMethod()) {
            return $this->nextRequestMethodHandler->exec(
                $requestMethod,
                $requestURI,
                $controllerReference,
                $requestArguments
            );
        }

        throw new Exception($message = 'Method not supported', $code = 404);
    }

    /**
     * @param string $requestMethod
     * @return bool
     */
    private static function canHandleRequestMethod(string $requestMethod): bool
    {
        return $requestMethod === self::REQUEST_METHOD;
    }

    private function hasNextRequestMethod(): bool
    {
        return !empty($this->nextRequestMethodHandler);
    }

    /**
     * @param RequestMethodHandler|null $nextRequestMethodHandler
     * @return RequestMethodHandler
     */
    public function setNextRequestMethodHandler(?RequestMethodHandler $nextRequestMethodHandler): RequestMethodHandler
    {
        $this->nextRequestMethodHandler = $nextRequestMethodHandler;
        return $this;
    }
}

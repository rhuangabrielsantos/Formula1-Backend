<?php

namespace Core\Controller;

interface ControllerInterface
{
    public function index(?int $id): ControllerResponse;

    public function create(array $requestArguments): ControllerResponse;

    public function update(int $id, array $requestArguments): ControllerResponse;

    public function delete(int $id): ControllerResponse;
}

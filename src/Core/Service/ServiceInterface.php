<?php

namespace Core\Service;

use Core\Command\CommandInput;
use Core\Command\CommandResponse;

interface ServiceInterface
{
    public function exec(CommandInput $commandInput): CommandResponse;
}

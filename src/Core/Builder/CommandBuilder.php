<?php

namespace Core\Builder;

use Core\Command\CommandInput;

interface CommandBuilder
{
    public function getCommand(): CommandInput;
}

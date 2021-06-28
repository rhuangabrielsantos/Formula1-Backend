<?php

namespace Core\Command;

interface ChainBuilder
{
    public function setNextCommand(?Command $nextCommand): Command;
}

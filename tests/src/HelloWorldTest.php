<?php

namespace Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
    public function hi(): void
    {
        Assert::assertTrue(true);
    }
}

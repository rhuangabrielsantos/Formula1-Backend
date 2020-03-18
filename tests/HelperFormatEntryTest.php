<?php

use Helper\FormatEntry as FormatEntryAlias;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class HelperFormatEntryTest extends TestCase
{
    public $dataCars;

    /**
     * @dataProvider providerCarsForNewCarTests
     * @param array $arguments
     */
    public static function testIfReturnedNewCarsAreValid($arguments)
    {
        $returnedCars = (new FormatEntryAlias())->returnNewCars($arguments);

        $expectedCars = [
            'PilotOne',
            'AA',
            'BB',
            'Black',
            1998
        ];

        Assert::assertEquals($expectedCars, $returnedCars);
    }

    /**
     * @dataProvider providerCarsForNewCarTests
     * @param array $arguments
     */
    public static function testIfReturnedYearIsInt($arguments)
    {
        $returnedCars = (new FormatEntryAlias())->returnNewCars($arguments);

        Assert::assertIsInt($returnedCars[4]);
    }

    public function providerCarsForNewCarTests(): array
    {
        return [
            [
                ['executarComando', 'adicionarCarro', 'PilotOne', 'AA', 'BB', 'Black', '1998']
            ]
        ];
    }
}

<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Validations\BirthDate as Instance;

class BirthDateTest extends TestCase
{
    /**
     * Testa se função make retorna instância desejada
     */
    public function testShouldReturnBirthDateInstance()
    {
        $instance = Instance::make('testing');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    /**
     * Lista de combinações a serem testadas
     */
    public function birthDatesProvider()
    {
        return [
            'data vazia' => ['', false],
            'data com apenas o ano' => [date('Y'), false],
            'data com ano e mes' => [date('Y-m'), false],
            'data válida' => [date('Y-m-d'), true],
        ];
    }

    /**
     * @dataProvider birthDatesProvider
     */
    public function testBirthDates($data, $expected)
    {
        $instance = Instance::make('testing');
        $result = $instance->validate($data);
        $this->assertEquals($expected, $result);
    }
}

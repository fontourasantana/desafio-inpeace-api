<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Validations\Telephone as Instance;

class TelephoneTest extends TestCase
{
    /**
     * Testa se função make retorna instância desejada
     */
    public function testShouldReturnTelephoneInstance()
    {
        $instance = Instance::make('testing');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    /**
     * Lista de combinações a serem testadas
     */
    public function telephoneProvider()
    {
        return [
            'vazio' => ['', false],
            'letra' => ['a', false],
            'letras' => [str_repeat('a', 10), false],
            'letras e numeros' => [str_repeat('a1', 5), false],
            'numero' => ['1', false],
            'numeros' => [str_repeat('1', 10), true],
        ];
    }

    /**
     * @dataProvider telephoneProvider
     */
    public function testTelephones($data, $expected)
    {
        $instance = Instance::make('testing');
        $result = $instance->validate($data);
        $this->assertEquals($expected, $result);
    }
}

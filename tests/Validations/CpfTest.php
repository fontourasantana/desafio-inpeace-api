<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Validations\Cpf as Instance;

class CpfTest extends TestCase
{
    /**
     * Testa se função make retorna instância desejada
     */
    public function testShouldReturnCpfInstance()
    {
        $instance = Instance::make('testing');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    /**
     * Lista de combinações a serem testadas
     */
    public function cpfsProvider()
    {
        $cpfsInvalidos = [];
        for ($i = 0; $i < 10; $i++) {
            $cpfsInvalidos["cpf invalido preenchido com $i"] = [str_repeat($i, 11), false];
        }

        return array_merge($cpfsInvalidos, [
            'cpf vazio' => ['', false],
            'cpf com pontuação' => ['181.875.320-09', false],
            'cpf sem pontuação' => ['18187532009', true]
        ]);
    }

    /**
     * @dataProvider cpfsProvider
     */
    public function testCpfs($data, $expected)
    {
        $instance = Instance::make('testing');
        $result = $instance->validate($data);
        $this->assertEquals($expected, $result);
    }
}

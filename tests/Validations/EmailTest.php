<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Validations\Email as Instance;

class EmailTest extends TestCase
{
    /**
     * Testa se função make retorna instância desejada
     */
    public function testShouldReturnEmailInstance()
    {
        $instance = Instance::make('testing');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    /**
     * Lista de combinações a serem testadas
     */
    public function emailsProvider()
    {
        return [
            'email vazio' => ['', false],
            'email com apenas @' => ['@', false],
            'email com apenas @ e .' => ['@.', false],
            'email formato inválido 1' => ['a@.', false],
            'email formato inválido 2' => ['@a.', false],
            'email formato inválido 3' => ['@.a', false],
            'email formato inválido 4' => ['a@a.', false],
            'email formato inválido 5' => ['a@.a', false],
            'email formato inválido 6' => ['@a.a', false],
            'email formato válido' => ['a@a.a', true],
        ];
    }

    /**
     * @dataProvider emailsProvider
     */
    public function testEmails($data, $expected)
    {
        $instance = Instance::make('testing');
        $result = $instance->validate($data);
        $this->assertEquals($expected, $result);
    }
}

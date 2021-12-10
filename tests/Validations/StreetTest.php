<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Validations\Street as Instance;

class StreetTest extends TestCase
{
    /**
     * Testa se função make retorna instância desejada
     */
    public function testShouldReturnStreetInstance()
    {
        $instance = Instance::make('testing');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    /**
     * Lista de combinações a serem testadas
     */
    public function streetProvider()
    {
        return [
            'nome minusculo' => ['street', true],
            'nome maisculo' => ['STREET', true],
            'nome com minusculas e maiusculas' => ['StreeT', true],
            'nome composto' => ['street street', true],
            'nome com caracters permitidos' => ['áàãâÁÀÃÂéèêÉÈÊíìîÍÌÎóòõôÓÒÕÔúùûÚÙÛçÇ.,', true],
            'nome com caracters permitidos e espaço' => ['áàãâÁÀÃÂéèêÉÈÊíìîÍÌÎóòõô ÓÒÕÔúùûÚÙÛçÇ.,', true],
            'tamanho minimo' => ['a', true],
            'tamanho máximo' => [str_repeat('a', 100), true],
            'nome com tamanho inválido (vazio)' => ['', false],
            'nome com tamanho inválido (máximo)' => [str_repeat('a', 101), false],
        ];
    }

    /**
     * @dataProvider streetProvider
     */
    public function testStreets($data, $expected)
    {
        $instance = Instance::make('testing');
        $result = $instance->validate($data);
        $this->assertEquals($expected, $result);
    }
}

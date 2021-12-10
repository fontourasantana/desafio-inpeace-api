<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Validations\City as Instance;

class CityTest extends TestCase
{
    /**
     * Testa se função make retorna instância desejada
     */
    public function testShouldReturnCityInstance()
    {
        $instance = Instance::make('testing');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    /**
     * Lista de combinações a serem testadas
     */
    public function citiesNamesProvider()
    {
        return [
            'nome minusculo' => ['city', true],
            'nome maisculo' => ['CITY', true],
            'nome com minusculas e maiusculas' => ['CiTy', true],
            'nome composto' => ['city name', true],
            'nome com acentos' => ['áàãâÁÀÃÂéèêÉÈÊíìîÍÌÎóòõôÓÒÕÔúùûÚÙÛçÇ', true],
            'nome com acentos composto' => ['áàãâÁÀÃÂéèêÉÈÊ íìîÍÌÎóòõôÓÒÕÔúùûÚÙÛçÇ', true],
            'tamanho minimo' => ['c', true],
            'tamanho máximo' => [str_repeat('c', 100), true],
            'nome com tamanho inválido (vazio)' => ['', false],
            'nome com tamanho inválido (máximo)' => [str_repeat('c', 101), false],
        ];
    }

    /**
     * @dataProvider citiesNamesProvider
     */
    public function testCitiesNames($data, $expected)
    {
        $instance = Instance::make('testing');
        $result = $instance->validate($data);
        $this->assertEquals($expected, $result);
    }
}

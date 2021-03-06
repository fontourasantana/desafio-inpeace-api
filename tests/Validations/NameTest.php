<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Validations\Name as Instance;

class NameTest extends TestCase
{
    /**
     * Testa se função make retorna instância desejada
     */
    public function testShouldReturnNameInstance()
    {
        $instance = Instance::make('testing');
        $this->assertInstanceOf(Instance::class, $instance);
    }

    /**
     * Lista de combinações a serem testadas
     */
    public function namesProvider()
    {
        return [
            'nome minusculo' => ['name', true],
            'nome maiusculo' => ['NAME', true],
            'nome com minusculas e maiusculas' => ['NaMe', true],
            'nome composto minusculo' => ['name name', true],
            'nome composto maiusculo' => ['NAME NAME', true],
            'nome composto minusculas e maiusculas' => ['NaMe NaMe', true],
            'nome com caracters especiais válidos' => ['.áàãâÁÀÃÂéèêÉÈÊíìîÍÌÎóòõôÓÒÕÔúùûÚÙÛçÇ', true],
            'nome com caracters especiais válidos composto' => ['.áàãâÁÀÃÂéèêÉÈÊ íìîÍÌÎóòõôÓÒÕÔúùûÚÙÛçÇ', true],
            'nome com caracters especiais inválidos' => ['!@#$%*()_+~`[{}];:\'",<>/?\\|', false],
            'nome com caracters especiais inválidos composto' => ['!@#$%*()_+~`[{ }];:\'",<>/?\\|', false],
            'tamanho minimo' => ['n', true],
            'tamanho máximo' => [str_repeat('n', 60), true],
            'nome com tamanho inválido (vazio)' => ['', false],
            'nome com tamanho inválido (máximo)' => [str_repeat('n', 61), false],
        ];
    }

    /**
     * @dataProvider namesProvider
     */
    public function testNames($data, $expected)
    {
        $instance = Instance::make('testing');
        $result = $instance->validate($data);
        $this->assertEquals($expected, $result);
    }
}

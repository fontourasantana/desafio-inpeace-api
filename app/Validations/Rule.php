<?php
namespace App\Validations;

abstract class Rule
{
    /**
     * @var string
     */
    protected $key;

    /**
     * Cria uma regra de validação
     *
     * @param  string  $key
     * @return void
     */
    protected function __construct($key)
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('É necessário informar a chave para criar a validação de telefone');
        }

        $this->key = $key;
    }

    /**
     * Cria uma regra de validação
     *
     * @param  string  $key
     * @return \App\Validations\Rule
     */
    abstract public static function make($key);

    /**
     * Determina se a regra de validação passa
     *
     * @param  mixed  $data
     * @return bool
     */
    abstract public function validate($data);

    /**
     * Retorna a mensagem de erro de validação
     *
     * @return string
     */
    abstract public function getErrorMessage();

    /**
     * Retorna chave de identificação da validação
     *
     * @return string
     */
    final public function getKey()
    {
        return $this->key;
    }
}

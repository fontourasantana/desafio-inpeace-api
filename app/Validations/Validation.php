<?php
namespace App\Validations;

abstract class Validation
{
    protected $key;

    protected function __construct($key)
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('É necessário informar a chave para criar a validação de telefone');
        }

        $this->key = $key;
    }

    abstract public function validate($data);

    abstract public function getErrorMessage();

    final public function getKey()
    {
        return $this->key;
    }
}

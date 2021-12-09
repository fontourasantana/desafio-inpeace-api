<?php
namespace App\Exceptions;

class EntityValidationException extends \Exception
{
    /**
     * @var array
     */
    private $errors;

    /**
     * Cria exceção de validação
     *
     * @param array $errors
     * @return void
     */
    public function __construct(array $errors)
    {
        parent::__construct($errors[0]);
        $this->errors = $errors;
    }

    /**
     * Retorna erros que ocorreram durante a validação
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}

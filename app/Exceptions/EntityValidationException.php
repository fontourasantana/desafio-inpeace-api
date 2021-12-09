<?php
namespace App\Exceptions;

class EntityValidationException extends \Exception
{
    private $errors;

    public function __construct(array $errors)
    {
        parent::__construct($errors[0]);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}

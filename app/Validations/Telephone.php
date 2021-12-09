<?php
namespace App\Validations;

use Respect\Validation\Validator as v;

class Telephone extends Rule
{
    public function __construct($key = '')
    {
        parent::__construct($key);
    }

    public static function make($key)
    {
        $instance = new self($key);
        return $instance;
    }

    public function validate($data)
    {
        return v::digit()->length(10, 10)->validate($data);
    }

    public function getErrorMessage()
    {
        return 'Telefone informado é inválido';
    }
}

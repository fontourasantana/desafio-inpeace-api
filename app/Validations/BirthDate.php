<?php
namespace App\Validations;

use Respect\Validation\Validator as v;

class BirthDate extends Validation
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
        return v::date('Y-m-d')->validate($data);
    }

    public function getErrorMessage()
    {
        return 'Data de nascimento informada é inválida';
    }
}

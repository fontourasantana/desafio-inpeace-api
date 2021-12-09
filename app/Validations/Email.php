<?php
namespace App\Validations;

use Respect\Validation\Validator as v;

class Email extends Validation
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
        return v::email()->validate($data);
    }

    public function getErrorMessage()
    {
        return 'Email informado é inválido';
    }
}

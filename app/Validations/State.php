<?php
namespace App\Validations;

use Respect\Validation\Validator as v;

class State extends Validation
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
        return v::subdivisionCode('BR')->validate($data);
    }

    public function getErrorMessage()
    {
        return 'Estado informado é inválido';
    }
}

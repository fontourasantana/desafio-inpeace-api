<?php
namespace App\Validations;

use Respect\Validation\Validator as v;

class Name extends Validation
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
        return v::alpha(' áàãâÁÀÃÂéèêÉÈÊíìîÍÌÎóòõôÓÒÕÔúùûÚÙÛçÇ')->length(1, 60)->validate($data);
    }

    public function getErrorMessage()
    {
        return 'Nome informado é inválido';
    }
}

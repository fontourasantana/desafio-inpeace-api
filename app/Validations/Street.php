<?php
namespace App\Validations;

use Respect\Validation\Validator as v;

class Street extends Rule
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
        return v::alnum(' áàãâÁÀÃÂéèêÉÈÊíìîÍÌÎóòõôÓÒÕÔúùûÚÙÛçÇ.,')->length(1, 100, true)->validate($data);
    }

    public function getErrorMessage()
    {
        return 'Logradouro informado é inválido';
    }
}

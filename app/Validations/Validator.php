<?php
namespace App\Validations;

class Validator
{
    private $validations = [];
    private $errors = [];
    private $data = [];

    public static function make(array $data, array $validations)
    {
        $instance = new self;

        $instance->setData($data);

        foreach ($validations as $validation) {
            $instance->append($validation);
        }

        return $instance;
    }

    private function setData($data)
    {
        $this->data = $data;
    }

    private function append(Validation $v)
    {
        $this->validations[$v->getKey()] = $v;
    }

    public function validate()
    {
        $this->checkKeys();

        foreach ($this->validations as $key => $validation) {
            if ($validation->validate($this->data[$key])) {
                continue;
            }

            $this->addErrorMessage($validation->getErrorMessage());
        }

        return !$this->hasErrors();
    }

    private function checkKeys()
    {
        $validationKeys = array_keys($this->validations);
        $dataKeys = array_keys($this->data);
        $diff = array_diff($validationKeys, $dataKeys);
        if (count($diff) != 0) {
            throw new \Exception('É necessário preencher todos os campos para realizar as validações');
        }
    }

    private function addErrorMessage($message)
    {
        $this->errors[] = $message;
    }

    private function hasErrors()
    {
        return count($this->errors) != 0;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}

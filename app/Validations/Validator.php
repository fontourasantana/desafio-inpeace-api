<?php
namespace App\Validations;

class Validator
{
    /**
     * @var array
     */
    private $validations = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * Cria uma instancia de validação
     *
     * @param  array  $data
     * @param  array  $validations
     * @return \App\Validations\Validator
     */
    public static function make(array $data, array $validations)
    {
        $instance = new self;

        $instance->setData($data);

        foreach ($validations as $validation) {
            $instance->append($validation);
        }

        return $instance;
    }

    /**
     * Armazena dados para serem validados
     *
     * @param  array  $data
     * @return void
     */
    private function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Adiciona regra de validação a lista de validações
     *
     * @param  \App\Validations\Rule  $v
     * @return void
     */
    private function append(Rule $v)
    {
        $this->validations[$v->getKey()] = $v;
    }

    /**
     * Determina se todas regras de validações passan
     *
     * @return bool
     */
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

    /**
     * Verifica há validações para todos dados
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    private function checkKeys()
    {
        $validationKeys = array_keys($this->validations);
        $dataKeys = array_keys($this->data);
        $diff = array_diff($validationKeys, $dataKeys);
        if (count($diff) != 0) {
            throw new \InvalidArgumentException('É necessário preencher todos os campos para realizar as validações');
        }
    }

    /**
     * Adiciona mensagem de erro ao container de erros
     *
     * @return void
     */
    private function addErrorMessage($message)
    {
        $this->errors[] = $message;
    }

    /**
     * Determina se houve erros nas validações
     *
     * @return bool
     */
    private function hasErrors()
    {
        return count($this->errors) != 0;
    }

    /**
     * Retorna todos erros que ocorreram durante as validações
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}

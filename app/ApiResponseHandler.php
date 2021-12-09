<?php
namespace App;

class ApiResponseHandler
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $keys = ['status', 'message', 'data'];

    /**
     * Define resposta da api como sucesso, message e código
     *
     * @param string $message
     * @param int $code
     * @return $this
     */
    public function success(string $message = '', int $code = 200)
    {
        if (!empty($message)) {
            $this->attributes['message'] = $message;
        }

        $this->attributes['status'] = 'success';
        $this->attributes['code'] = $code;
        return $this;
    }

    /**
     * Define resposta da api como error, message e código
     *
     * @param string $message
     * @param int $code
     * @return $this
     */
    public function error(string $message = '', int $code = 400)
    {
        if (!empty($message)) {
            $this->attributes['message'] = $message;
        }

        $this->attributes['status'] = 'error';
        $this->attributes['code'] = $code;
        return $this;
    }

    /**
     * Define resposta da api como sucesso, message e código 201
     *
     * @param string $message
     * @return $this
     */
    public function created(string $message = '')
    {
        return $this->success($message, 201);
    }

    /**
     * Define dados da resposta da api
     *
     * @param array $data
     * @return $this
     */
    public function data(array $data)
    {
        $this->attributes['data'] = $data;
        return $this;
    }

    /**
     * Cria resposta retornada pela api
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \InvalidArgumentException
     */
    public function send()
    {
        if (!$this->validate()) {
            throw new \InvalidArgumentException(
                'É necessário informar pelo menos um modo de resposta'
            );
        }

        $response = $this->prepare();

        return response()->json($response['data'], $response['code']);
    }

    /**
     * Valida dados necessários para criar resposta
     *
     * @return bool
     */
    private function validate()
    {
        return isset($this->attributes['status']);
    }

    /**
     * Prepara resposta com os dados informados
     *
     * @return array
     */
    private function prepare()
    {
        $data = [];
        $code = $this->attributes['code'];

        foreach ($this->keys as $key) {
            if (isset($this->attributes[$key])) {
                $data[$key] = $this->attributes[$key];
            }
        }

        return compact('data', 'code');
    }
}

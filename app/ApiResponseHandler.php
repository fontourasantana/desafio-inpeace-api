<?php
namespace App;

class ApiResponseHandler
{
    private $attributes = [];

    private $keys = ['status', 'message', 'data'];

    public function success($message = '', $code = 200)
    {
        // verificar se é uma string
        if (!empty($message)) {
            $this->attributes['message'] = $message;
        }
        $this->attributes['status'] = 'success';
        $this->attributes['code'] = $code;
        return $this;
    }

    public function created($message = '', $code = 201)
    {
        if (!empty($message)) {
            $this->attributes['message'] = $message;
        }
        $this->attributes['status'] = 'success';
        $this->attributes['code'] = $code;
        return $this;
    }

    public function error($message = '', $code = 400)
    {
        if (!empty($message)) {
            $this->attributes['message'] = $message;
        }
        $this->attributes['status'] = 'error';
        $this->attributes['code'] = $code;
        return $this;
    }

    public function data($data)
    {
        $this->attributes['data'] = $data;
        return $this;
    }

    public function send()
    {
        $response = [];
        $keys = $this->keys;
        $attributes = $this->attributes;

        if (!isset($attributes['status'])) {
            throw new \Exception(
                'É necessário informar pelo menos um modo de resposta'
            );
        }

        foreach ($keys as $key) {
            if (isset($attributes[$key])) {
                $response = array_merge($response, [
                    "$key" => $attributes[$key],
                ]);
            }
        }

        return response()->json($response, $attributes['code']);
    }
}

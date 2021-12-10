<?php
namespace App\Contracts\Factories;

use Illuminate\Http\Request;
use App\Entities\User;

interface UserFactory
{
    /**
     * Cria entidade usuário por dados da request da api
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Entities\User
     *
     * @throws \App\Exceptions\RequiredAttributesException
     */
    public function makeFromRequest(Request $request);

    /**
     * Cria entidade usuário por lista de atributos do banco de dados
     *
     * @param array $attributes
     * @return \App\Entities\User
     */
    public function makeFromAttributes(array $attributes);
}

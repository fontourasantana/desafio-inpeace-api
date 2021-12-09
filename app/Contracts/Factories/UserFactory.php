<?php
namespace App\Contracts\Factories;

use Illuminate\Http\Request;
use App\Entities\User;

interface UserFactory
{
    /**
     * Cria entidade usuário pela request da api
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Entities\User
     */
    public function makeFromRequest(Request $request);

    /**
     * Cria entidade usuário por lista de atributos
     *
     * @param array $attributes
     * @return \App\Entities\User
     */
    public function makeFromAttributes(array $attributes);
}

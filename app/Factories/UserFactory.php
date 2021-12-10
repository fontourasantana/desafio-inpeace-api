<?php
namespace App\Factories;

use App\Contracts\Factories\UserFactory as IUserFactory;
use Illuminate\Http\Request;
use App\Entities\User;
use DateTime;

class UserFactory implements IUserFactory
{
    /**
     * Cria entidade usuário por dados da request da api
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Entities\User
     */
    public function makeFromRequest(Request $request)
    {
        $data = $request->only(['nome', 'cpf', 'dataNascimento', 'email', 'telefone', 'logradouro', 'cidade', 'estado']);
        $data = array_map('trim', $data);

        $entity = new User;

        $entity->setName($data['nome']);
        $entity->setCpf($data['cpf']);
        $entity->setBithDate($data['dataNascimento']);
        $entity->setEmail($data['email']);
        $entity->setTelephone($data['telefone']);
        $entity->setStreet($data['logradouro']);
        $entity->setCity($data['cidade']);
        $entity->setState($data['estado']);

        return $entity;
    }

    /**
     * Cria entidade usuário por lista de atributos do banco de dados
     *
     * @param array $attributes
     * @return \App\Entities\User
     */
    public function makeFromAttributes(array $attributes)
    {
        $entity = new User;

        $entity->setId($attributes['id']);
        $entity->setName($attributes['nome']);
        $entity->setCpf($attributes['cpf']);
        $entity->setBithDate($attributes['dataNascimento']);
        $entity->setEmail($attributes['email']);
        $entity->setTelephone($attributes['telefone']);
        $entity->setStreet($attributes['logradouro']);
        $entity->setCity($attributes['cidade']);
        $entity->setState($attributes['estado']);
        $entity->setCreatedAt(new DateTime($attributes['created_at']));
        $entity->setUpdatedAt(new DateTime($attributes['updated_at']));

        return $entity;
    }
}

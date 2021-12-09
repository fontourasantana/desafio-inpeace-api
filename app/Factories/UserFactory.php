<?php
namespace App\Factories;

use App\Contracts\Factories\UserFactory as IUserFactory;
use Illuminate\Http\Request;
use App\Entities\User;

class UserFactory implements IUserFactory
{
    /**
     * @param Request $request
     * @return \App\Entities\User
     */
    public function makeFromRequest(Request $request)
    {
        $data = $request->only(['nome', 'cpf', 'dataNascimento', 'email', 'telefone', 'logradouro', 'cidade', 'estado']);

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
        $entity->setCreatedAt($attributes['created_at']);
        $entity->setUpdatedAt($attributes['updated_at']);

        return $entity;
    }
}

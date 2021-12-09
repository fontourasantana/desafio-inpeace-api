<?php
namespace App\Factories;

use Illuminate\Http\Request;
use App\Entities\User;

class UserFactory
{
    /**
     * @param Request $request
     * @return User
     */
    public static function makeEntityFromRequest(Request $request)
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
     * @param Array $attributes
     * @return User
     */
    public static function makeEntityFromAttributes(array $attributes)
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

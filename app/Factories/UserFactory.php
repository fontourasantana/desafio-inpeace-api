<?php
namespace App\Factories;

use App\Contracts\Factories\UserFactory as IUserFactory;
use App\Exceptions\RequiredAttributesException;
use Illuminate\Http\Request;
use App\Entities\User;
use DateTime;

class UserFactory implements IUserFactory
{
    /**
     * @var array
     */
    private $requiredAttributes = ['nome', 'cpf', 'dataNascimento', 'email', 'telefone', 'logradouro', 'cidade', 'estado'];

    /**
     * Cria entidade usuário por dados da request da api
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Entities\User
     *
     * @throws \App\Exceptions\RequiredAttributesException
     */
    public function makeFromRequest(Request $request)
    {
        if (!$request->has($this->requiredAttributes)) {
            throw new RequiredAttributesException;
        }

        $data = $request->only($this->requiredAttributes);
        $data = array_map('trim', $data);

        $entity = new User;

        $entity->setName($data['nome']);
        $entity->setCpf($data['cpf']);
        $entity->setBirthDate($data['dataNascimento']);
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
        $entity->setBirthDate($attributes['dataNascimento']);
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

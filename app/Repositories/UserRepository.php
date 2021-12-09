<?php
namespace App\Repositories;

use App\Models\User;
use App\Entities\User as Entity;
use App\Contracts\Factories\UserFactory;
use App\Contracts\Repositories\UserRepository as IUserRepository;

class UserRepository implements IUserRepository
{
    private $primaryKey = 'id';

    private $entityFactory;

    public function __construct(UserFactory $entityFactory)
    {
        $this->entityFactory = $entityFactory;
    }

    public function getAll()
    {
        $users = User::all();
        return $users->map(fn ($user) => $this->entityFactory->makeFromAttributes($user->getAttributes()));
    }

    public function getById(int $id)
    {
        $model = User::find($id);
        return $model ? $this->entityFactory->makeFromAttributes($model->getAttributes()) : null;
    }

    public function save(Entity $user)
    {
        $model = new User;
        $model->nome = $user->getName();
        $model->cpf = $user->getCpf();
        $model->dataNascimento = $user->getBithDate();
        $model->email = $user->getEmail();
        $model->telefone = $user->getTelephone();
        $model->logradouro = $user->getStreet();
        $model->cidade = $user->getCity();
        $model->estado = $user->getState();
        $model->save();

        $user->setId($model->id);
        $user->setCreatedAt($model->created_at);
        $user->setUpdatedAt($model->updated_at);

        return $user;
    }

    public function update(Entity $user)
    {
        $model = User::find($user->getId());
        $model->nome = $user->getName();
        $model->cpf = $user->getCpf();
        $model->dataNascimento = $user->getBithDate();
        $model->email = $user->getEmail();
        $model->telefone = $user->getTelephone();
        $model->logradouro = $user->getStreet();
        $model->cidade = $user->getCity();
        $model->estado = $user->getState();
        $model->save();

        $user->setUpdatedAt($model->updated_at);
        return $user;
    }

    public function delete(Entity $user)
    {
        return User::where($this->primaryKey, $user->getId())
            ->delete();
    }
}

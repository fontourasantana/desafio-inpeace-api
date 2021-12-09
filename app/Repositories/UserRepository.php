<?php
namespace App\Repositories;

use App\Models\User;
use App\Entities\User as Entity;
use App\Contracts\Factories\UserFactory;
use App\Contracts\Repositories\UserRepository as IUserRepository;

class UserRepository implements IUserRepository
{
    /**
     * @var string
     */
    private $primaryKey = 'id';

    /**
     * Implementação da UserFactory
     *
     * @var \App\Contracts\Factories\UserFactory
     */
    private $entityFactory;

    /**
     * @param \App\Contracts\Factories\UserFactory $entityFactory
     * @return void
     */
    public function __construct(UserFactory $entityFactory)
    {
        $this->entityFactory = $entityFactory;
    }

    /**
     * Retorna todos usuários cadastrados no banco de dados
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        $users = User::all();
        return $users->map(fn ($user) => $this->entityFactory->makeFromAttributes($user->getAttributes()));
    }

    /**
     * Retorna usuário pelo id do banco de dados
     *
     * @param int $id
     * @return \App\Entities\User|null
     */
    public function getById(int $id)
    {
        $model = User::find($id);
        return $model ? $this->entityFactory->makeFromAttributes($model->getAttributes()) : null;
    }

    /**
     * Salva usuário no banco de dados
     *
     * @param \App\Entities\User $user
     * @return \App\Entities\User
     */
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

    /**
     * Atualiza usuário no banco de dados
     *
     * @param \App\Entities\User $user
     * @return \App\Entities\User
     */
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

    /**
     * Deleta usuário no banco de dados
     *
     * @param \App\Entities\User $user
     * @return bool
     */
    public function delete(Entity $user)
    {
        $result = User::where($this->primaryKey, $user->getId())
            ->delete();

        return $result == 1;
    }
}

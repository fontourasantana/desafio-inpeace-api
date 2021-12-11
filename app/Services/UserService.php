<?php
namespace App\Services;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\UserService as IUserService;
use App\Entities\User;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\EntityValidationException;

class UserService implements IUserService
{
    /**
     * Implementação da UserRepository
     *
     * @var \App\Contracts\Repositories\UserRepository
     */
    private $repository;

    /**
     * @param \App\Contracts\Repositories\UserRepository $repository
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna todos usuários cadastrados no repositório
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Retorna usuário pelo id no repositório
     *
     * @param int $id
     * @return \App\Entities\User
     *
     * @throws \App\Exceptions\EntityNotFoundException
     */
    public function getById(int $id)
    {
        $user = $this->repository->getById($id);

        if (!$user) {
            throw new EntityNotFoundException('Não foi possível encontrar usuário informado');
        }

        return $user;
    }

    /**
     * Salva usuário no repositório
     *
     * @param \App\Entities\User $user
     * @return \App\Entities\User
     *
     * @throws \App\Exceptions\EntityValidationException
     */
    public function save(User $user)
    {
        $validator = $user->getValidator();

        if (!$validator->validate()) {
            throw new EntityValidationException($validator->getErrors());
        }

        return $this->repository->save($user);
    }

    /**
     * Atualiza usuário no repositório
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\User $dto
     * @return \App\Entities\User
     *
     * @throws \App\Exceptions\EntityValidationException
     */
    public function update(User $user, User $dto)
    {
        $user = $this->prepareUpdate($user, $dto);

        $validator = $user->getValidator();

        if (!$validator->validate()) {
            throw new EntityValidationException($validator->getErrors());
        }

        return $this->repository->update($user);
    }

    /**
     * Atualiza do usuário apenas os dados permitidos
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\User $dto
     * @return \App\Entities\User
     */
    private function prepareUpdate(User $user, User $dto)
    {
        $user->setName($dto->getName());
        $user->setCpf($dto->getCpf());
        $user->setBirthDate($dto->getBirthDate());
        $user->setEmail($dto->getEmail());
        $user->setTelephone($dto->getTelephone());
        $user->setStreet($dto->getStreet());
        $user->setCity($dto->getCity());
        $user->setState($dto->getState());
        return $user;
    }

    /**
     * Deleta usuário no repositório
     *
     * @param \App\Entities\User $user
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function delete(User $user)
    {
        $deleted = $this->repository->delete($user);

        if (!$deleted) {
            throw new \InvalidArgumentException('Não foi possível deletar usuário informado');
        }
    }
}

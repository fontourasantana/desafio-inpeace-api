<?php
namespace App\Services;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\UserService as IUserService;
use App\Entities\User;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\EntityValidationException;

class UserService implements IUserService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById(int $id)
    {
        $user = $this->repository->getById($id);

        if (!$user) {
            throw new EntityNotFoundException('Não foi possível encontrar usuário informado');
        }

        return $user;
    }

    public function save(User $user)
    {
        $validator = $user->getValidator();

        if (!$validator->validate()) {
            throw new EntityValidationException($validator->getErrors());
        }

        return $this->repository->save($user);
    }

    public function update(User $user)
    {
        $validator = $user->getValidator();

        if (!$validator->validate()) {
            throw new EntityValidationException($validator->getErrors());
        }

        return $this->repository->update($user);
    }

    public function delete(User $user)
    {
        $this->repository->delete($user);
    }
}

<?php
namespace App\Contracts\Services;

use App\Entities\User;

interface UserService
{
    /**
     * Retorna todos usuários cadastrados no repositório
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll();

    /**
     * Retorna usuário pelo id no repositório
     *
     * @param int $id
     * @return \App\Entities\User|null
     *
     * @throws \App\Exceptions\EntityNotFoundException
     */
    public function getById(int $id);

    /**
     * Salva usuário no repositório
     *
     * @param \App\Entities\User $user
     * @return \App\Entities\User
     *
     * @throws \App\Exceptions\EntityValidationException
     */
    public function save(User $user);

    /**
     * Atualiza usuário no repositório
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\User $dto
     * @return \App\Entities\User
     *
     * @throws \App\Exceptions\EntityValidationException
     */
    public function update(User $user, User $dto);

    /**
     * Deleta usuário no repositório
     *
     * @param \App\Entities\User $user
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function delete(User $user);
}

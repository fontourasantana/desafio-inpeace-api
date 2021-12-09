<?php
namespace App\Contracts\Repositories;

use App\Entities\User;

interface UserRepository
{
    /**
     * Retorna todos usuários cadastrados no banco de dados
     *
     * @return array
     */
    public function getAll();

    /**
     * Retorna usuário pelo id do banco de dados
     *
     * @param int $id
     * @return \App\Entities\User|null
     */
    public function getById(int $id);

    /**
     * Salva usuário no banco de dados
     *
     * @param \App\Entities\User $user
     * @return \App\Entities\User
     */
    public function save(User $user);

    /**
     * Atualiza usuário no banco de dados
     *
     * @param \App\Entities\User $user
     * @return \App\Entities\User
     */
    public function update(User $user);

    /**
     * Deleta usuário no banco de dados
     *
     * @param \App\Entities\User $user
     * @return bool
     */
    public function delete(User $user);
}

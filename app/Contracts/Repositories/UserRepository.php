<?php
namespace App\Contracts\Repositories;

use App\Entities\User;

interface UserRepository
{
    public function getAll();

    public function getById(int $id);

    public function save(User $user);

    public function update(User $user);

    public function delete(User $user);
}

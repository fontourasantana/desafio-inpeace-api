<?php
namespace App\Contracts\Services;

use App\Entities\User;

interface UserService
{
    public function getAll();

    public function getById(int $id);

    public function save(User $user);

    public function update(User $user);

    public function delete(User $user);
}

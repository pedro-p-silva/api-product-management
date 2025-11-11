<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements BaseRepositoryInterface
{

    public function getAll(): Collection
    {
        return User::select('id', 'name', 'email', 'photo_path')->get();
    }

    public function getById(int $id): User
    {
        return User::select('id', 'name', 'email', 'photo_path')->findOrFail($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        return User::findOrFail($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return User::findOrFail($id)->delete();
    }
}

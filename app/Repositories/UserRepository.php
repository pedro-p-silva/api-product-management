<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository implements BaseRepositoryInterface
{

    public function getAll(): Collection
    {
        return User::all();
    }

    public function getById(int $id): Model
    {
        return User::query()->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return User::query()->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return User::query()->findOrFail($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return User::query()->findOrFail($id)->delete();
    }
}

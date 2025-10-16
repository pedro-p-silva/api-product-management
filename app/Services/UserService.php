<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getById(int $id): Model
    {
        return $this->userRepository->getById($id);
    }

    public function create(array $data): Model
    {
        $data['password'] = Hash::make($data['password']);
        unset($data['password_confirmation']);

        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}

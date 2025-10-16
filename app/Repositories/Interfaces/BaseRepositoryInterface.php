<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): object;
    public function create(array $data): object;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}

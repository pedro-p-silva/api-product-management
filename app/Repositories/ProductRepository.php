<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements BaseRepositoryInterface
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getById(int $id): Model
    {
        return Product::query()->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return Product::query()->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return Product::query()->findOrFail($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return Product::query()->findOrFail($id)->delete();
    }
}

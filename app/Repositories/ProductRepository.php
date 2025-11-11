<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements BaseRepositoryInterface
{
    public function getAll(): Collection
    {
        return Product::select('id', 'name', 'description', 'price', 'status')->get();
    }

    public function getById(int $id): Product
    {
        return Product::select('id', 'name', 'description', 'price', 'status')->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
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

<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function get(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function getById(int $id): Model
    {
        return $this->productRepository->getById($id);
    }

    public function create(array $data): Model
    {
        return $this->productRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Product\ProductIdRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProducts(): JsonResponse
    {
        return response()->json($this->productService->get());
    }

    public function getProductById(ProductIdRequest $request): JsonResponse
    {
        return response()->json($this->productService->getById($request->validated('id')));
    }

    public function createProduct(CreateProductRequest $request): JsonResponse
    {
        return response()->json($this->productService->create($request->validated()), Response::HTTP_CREATED);
    }

    public function updateProduct(ProductIdRequest $requestId, UpdateProductRequest $requestData): JsonResponse
    {
        return response()->json($this->productService->update($requestId->validated('id'), $requestData->validated()));
    }

    public function deleteProduct(ProductIdRequest $request): JsonResponse
    {
        return response()->json($this->productService->delete($request->validated('id')));
    }
}

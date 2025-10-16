<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserIdRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUsers(): JsonResponse
    {
        return response()->json($this->userService->get());
    }

    public function getUserById(UserIdRequest $request): JsonResponse
    {
        return response()->json($this->userService->getById($request->validated('id')));
    }

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        return response()->json($this->userService->create($request->validated()), Response::HTTP_CREATED);
    }

    public function updateUser(UserIdRequest $requestId, UpdateUserRequest $requestData): JsonResponse
    {
        return response()->json($this->userService->update($requestId->validated('id'), $requestData->validated()));
    }

    public function deleteUser(UserIdRequest $request): JsonResponse
    {
        return response()->json($this->userService->delete($request->validated('id')));
    }
}

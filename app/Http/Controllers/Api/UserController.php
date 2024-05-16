<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\UserModel;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getUsers(): JsonResponse
    {
        return response()->json($this->userModel::all());
    }
}

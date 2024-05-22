<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Api\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generate_token(Request $request): JsonResponse
    {
        if ($this->validateStatusUser() != 1){
            return response()->json(['error' => 'Not token (Inactive login)'], 401);
        }

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Refresh token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh_token(Request $request): JsonResponse
    {
        if ($this->validateStatusUser() != 1){
            return response()->json(['error' => 'Not refresh (Inactive login)'], 401);
        }

        $credentials = $request->only(['email', 'password']);

        if (!auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = JWTAuth::parseToken()->refresh(true);

        $refresh_token = response()->json([
            'refresh_token' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 120
        ]);

        if ($refresh_token) {
            return $refresh_token;
        }

        return response()->json(['error' => 'Error generate refresh token']);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout_token(): JsonResponse
    {
        auth('api')->logout(true);

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    private function validateStatusUser()
    {
        $status_user = UserModel::query()->select('name', 'status')->first();
        return $status_user->status;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Helpers\HelperMessages;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Models\Api\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Jobs\UserRegister;

class UserController extends Controller
{
    private UserModel $user;
    private AuthController $userLoggerApi;
    private HelperMessages $helperMessage;
    private Request $request;

    public function __construct(UserModel $userModel, AuthController $userLoggerApi, HelperMessages $helperMessage, Request $request)
    {
        $this->user = $userModel;
        $this->helperMessage = $helperMessage;
        $this->userLoggerApi = $userLoggerApi;
        $this->request = $request;
    }

    public function getUsers(): JsonResponse
    {
        $searchPermission = $this->searchPermissions($this->request);
        $result = Helper::getDataLike($searchPermission, $this->user);

        if ($result){
            return response()->json($result);
        }

        return response()->json($this->user->all());
    }

    public function getUserById($id): JsonResponse
    {
        if (!is_numeric($id)) {
            return $this->helperMessage::msgNumericId();
        }

        $userById = $this->user::query()->where('id', '=', $id)->first();

        if (!$userById) {
            return $this->helperMessage::msgRegisterNotFound($id);
        }

        return response()->json($userById);
    }

    public function createUser()
    {
        $data = $this->request->post();

        $validator = Validator::make($this->request->all(),
            [
                'name' => 'required|min:5|max:191',
                'email' => 'required|email',
                'password' => 'required|string',
                'status' => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        try {
            $createUser = $this->user::create(
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'status' => $data['status']
                ]
            );

            if ($createUser) {
                UserRegister::dispatch($createUser)->delay(now()->addSeconds(60));
            }
        } catch (\Exception $e) {
            return $this->helperMessage::msgDatabaseExceptions();
        }

        if (!$createUser) {
            return $this->helperMessage::msgRegistrationNotComplete();
        }

        return $createUser;
    }

    public function putUserById($id): JsonResponse
    {
        $data = $this->request->post();

        if (!is_numeric($id)) {
            return $this->helperMessage::msgNumericId();
        }

        $userById = UserModel::query()->select('id')->where('id', '=', $id)->first();

        if (!$userById){
            return HelperMessages::msgRegisterNotFound($id);
        }

        $userLogger = $this->userLoggerApi->me()->getData();

        if ($id != $userLogger->id){
            return $this->helperMessage::msgNoPermissionChangeEmailOrPassword();
        }

        $putUserById = $this->user::query()
            ->where('id', '=', $id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status' => $data['status']
            ]);

        if (!$putUserById) {
            return $this->helperMessage::msgDataHasNotBeenAltered();
        }

        return $this->helperMessage::msgDataHasBeenChanged();
    }

    public function removeUserById($id): JsonResponse
    {
        if (!is_numeric($id)) {
            return $this->helperMessage::msgNumericId();
        }

        $userById = UserModel::query()->select('id')->where('id', '=', $id)->first();

        if (!$userById){
            return HelperMessages::msgRegisterNotFound($id);
        }

        $removeUserById = $this->user::query()
            ->where('id', '=', $id)
            ->delete();

        if (!$removeUserById) {
            return $this->helperMessage::msgRegisterNotFound($id);
        }

        return $this->helperMessage::msgRegistrationRemoved($id);
    }

    private function searchPermissions($request): array
    {
        return [
            [
                "existParam" => $request->has('name'),
                "key" => "name",
                "value" => $request->get("name")
            ],

            [
                "existParam" => $request->has('email'),
                "key" => "email",
                "value" => $request->get("email")
            ],

            [
                "existParam" => $request->has('status'),
                "key" => "status",
                "value" => $request->get("status")
            ]
        ];
    }
}

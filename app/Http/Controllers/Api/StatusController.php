<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HelperMessages;
use App\Http\Controllers\Controller;
use App\Models\Api\StatusModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    private StatusModel $status;
    private HelperMessages $helperMessage;
    private Request $request;

    public function __construct(StatusModel $status, HelperMessages $helperMessage, Request $request)
    {
        $this->status = $status;
        $this->helperMessage = $helperMessage;
        $this->request = $request;
    }

    public function getStatus(): JsonResponse
    {
        return response()->json($this->status::all());
    }

    public function createStatus()
    {
        $validator = Validator::make($this->request->all(),
            ['name' => 'required|min:5|max:70']
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        try {
            $createStatus = $this->status::create($this->request->all());
        } catch (\Exception $e) {
            return $this->helperMessage::msgDatabaseExceptions();
        }

        if (!$createStatus->id) {
            return $this->helperMessage::msgRegistrationNotComplete();
        }

        return $createStatus;
    }
}

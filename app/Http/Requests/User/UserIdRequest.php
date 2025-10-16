<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Base\BaseIdRequest;

class UserIdRequest extends BaseIdRequest
{
    protected string $table = 'users';
}

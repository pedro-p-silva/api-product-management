<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Base\BaseIdRequest;

class ProductIdRequest extends BaseIdRequest
{
    protected string $table = 'products';
}

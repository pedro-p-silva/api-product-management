<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HelperMessages;
use App\Http\Controllers\Controller;
use App\Models\Api\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private CategoryModel $category;
    private HelperMessages $helperMessage;
    private Request $request;

    public function __construct(CategoryModel $category, HelperMessages $helperMessage, Request $request)
    {
        $this->category = $category;
        $this->helperMessage = $helperMessage;
        $this->request = $request;
    }

    public function createCategory()
    {
        $validator = Validator::make($this->request->all(),
            ['name' => 'required|min:5|max:70', 'status' => 'required|numeric']
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        try {
            $createCategory = $this->category::create($this->request->all());
        } catch (\Exception $e) {
            return $this->helperMessage::msgDatabaseExceptions();
        }

        if (!$createCategory->id) {
            return $this->helperMessage::msgRegistrationNotComplete();
        }

        return $createCategory;
    }
}

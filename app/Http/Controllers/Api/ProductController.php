<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Helpers\HelperMessages;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Api\ProductModel;
use App\Http\Controllers\Api\Auth\AuthController;

class ProductController extends Controller
{
    private Request $request;
    private ProductModel $productModel;
    private HelperMessages $helperMessage;

    public function __construct(Request $request, ProductModel $productModel, HelperMessages $helperMessage, AuthController $userLoggerApi)
    {
        $this->request = $request;
        $this->productModel = $productModel;
        $this->helperMessage = $helperMessage;
    }

    public function getProducts(): JsonResponse
    {
        $searchPermission = $this->searchPermissions($this->request);
        $result = Helper::getDataLike($searchPermission, $this->productModel);

        if ($result){
            return response()->json($result);
        }

        return response()->json($this->productModel->query()->paginate(5));
    }

    public function getProductById($id): JsonResponse
    {
        if (!is_numeric($id)) {
            return $this->helperMessage::msgNumericId();
        }

        $productById = $this->productModel::query()->where('id', '=', $id)->first();

        if (!$productById) {
            return $this->helperMessage::msgRegisterNotFound($id);
        }

        return response()->json($productById);
    }

    public function createProduct()
    {
        $data = $this->request->post();

        $validator = Validator::make($this->request->all(),
            [
                'name' => 'required|min:3|max:100',
                'description' => 'min:5|max:300',
                'category' => 'required|numeric',
                'quantity' => 'required|numeric',
                'manufacturer' => 'required|min:3|max:191',
                'photo_path' => 'mimes:jpeg,png',
                'status' => 'required|numeric',
            ],
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        $dataProduct = ProductModel::query()
            ->where('name', '=', $data['name'])
            ->first();

        if ($dataProduct !== null) {
            if ($dataProduct['name'] == $data['name']) {
                return HelperMessages::msgUniqueValue($data['name']);
            }
        }

        try {
            $createUser = $this->productModel::create(
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'category' => $data['category'],
                    'quantity' => $data['quantity'],
                    'manufacturer' => $data['manufacturer'],
                    'photo_path' => Helper::validateImageFile($this->request, 'photo_path', 'public/product_image', 'CREATE'),
                    'status' => $data['status']
                ]
            );
        } catch (\Exception $e) {
            return $this->helperMessage::msgDatabaseExceptions();
        }

        return $createUser;
    }

    public function putProductById($id): JsonResponse
    {
        $data = $this->request->post();

        if (!is_numeric($id)) {
            return $this->helperMessage::msgNumericId();
        }

        $dataProduct = ProductModel::query()
            ->where('id', '=', $id)
            ->first();

        if (!$dataProduct){
            return HelperMessages::msgRegisterNotFound($id);
        }

        try {
            $putProductById = $this->productModel::query()
                ->where('id', '=', $id)
                ->update([
                        'name' => $data['name'],
                        'description' => $data['description'],
                        'category' => $data['category'],
                        'quantity' => $data['quantity'],
                        'manufacturer' => $data['manufacturer'],
                        'status' => $data['status']
                    ]
                );
        } catch (\Exception $e) {
            return $this->helperMessage::msgDatabaseExceptions();
        }

        if (!$putProductById) {
            return $this->helperMessage::msgDataHasNotBeenAltered();
        }

        Helper::validateImageFile($this->request, 'photo_path', 'public/product_image', 'UPDATE', $id, $dataProduct);
        return $this->helperMessage::msgDataHasBeenChanged();
    }

    public function patchUserById($id): JsonResponse
    {
        if (!is_numeric($id)) {
            return $this->helperMessage::msgNumericId();
        }

        $dataProduct = ProductModel::query()
            ->where('id', '=', $id)
            ->first();

        if (!$dataProduct) {
            return HelperMessages::msgRegisterNotFound($id);
        }

        try {
            $patchProduct = ProductModel::query()
                ->where('id', '=', $id)
                ->update($this->request->all());
        } catch (\Exception $e) {
            return $this->helperMessage::msgDatabaseExceptions();
        }

        if (!$patchProduct) {
            return $this->helperMessage::msgDataHasNotBeenAltered();
        }

        Helper::validateImageFile($this->request, 'photo_path', 'public/product_image', 'UPDATE', $id, $dataProduct);
        return $this->helperMessage::msgDataHasBeenChanged();
    }

    public function removeProductById($id): JsonResponse
    {
        if (!is_numeric($id)) {
            return $this->helperMessage::msgNumericId();
        }

        $product = $this->productModel::query()
            ->select('photo_path')
            ->where('id', '=', $id)
            ->first();

        if ($product && $product->photo_path !== null){
            Storage::delete($product->photo_path);
        }

        $removeProductById = $this->productModel::query()
            ->where('id', '=', $id)
            ->delete();

        if (!$removeProductById) {
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
                "existParam" => $request->has('manufacturer'),
                "key" => "manufacturer",
                "value" => $request->get("manufacturer")
            ],

            [
                "existParam" => $request->has('status'),
                "key" => "status",
                "value" => $request->get("status")
            ]
        ];
    }
}

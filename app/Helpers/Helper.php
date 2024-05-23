<?php

namespace App\Helpers;

use App\Models\Api\ProductModel;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function getDataLike($validateHas, $instance)
    {
        $like = [];
        $countParams = 0;
        foreach ($validateHas as $validate) {
            if ($validate['existParam']) {
                $countParams++;
                $like[] = "AND ${validate['key']} LIKE '%${validate['value']}%'";
            }
        }

        $strLike = implode($like);
        $strLength = strlen($strLike);
        $likeTreated = substr($strLike, 4, $strLength);

        if ($countParams > 0) {
            return $instance::query()
                ->whereRaw($likeTreated)
                ->get();
        }
        return false;
    }

    public static function validateImageFile($request, $key_file, $storeAs, $method, $id = null, $data = null)
    {
        if ($method == 'UPDATE') {
            if ($data['photo_path'] !== null) {
                Storage::delete([$data['photo_path']]);
            }
        }

        if ($request->hasFile($key_file)) {
            $filenameWithExt = $request->file($key_file)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($key_file)->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            if ($method == 'UPDATE') {
                ProductModel::query()
                    ->where('id', '=', $id)
                    ->update([
                        'photo_path' => $request->file($key_file)->storeAs($storeAs, $fileNameToStore) ?? null
                    ]);
            }

            return $request->file($key_file)->storeAs($storeAs, $fileNameToStore);
        }

        if ($method == 'UPDATE') {
            ProductModel::query()
                ->where('id', '=', $id)
                ->update([
                    'photo_path' => null
                ]);
        }

        return null;
    }
}

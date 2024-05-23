<?php

namespace App\Helpers;

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

    public static function validateImageFile($request, $key_file, $storeAs)
    {
        if ($request->hasFile($key_file)) {
            $filenameWithExt = $request->file($key_file)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file($key_file)->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            return $request->file($key_file)->storeAs($storeAs, $fileNameToStore);
        }
        return null;
    }
}

<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserImageService
{
    public function upload(UploadedFile $photo): string
    {
        $extension = $photo->getClientOriginalExtension() ?: 'png';
        $fileName = uniqid('user_') . '.' . $extension;

        $path = $photo->storeAs('users', $fileName, 's3');

        if (empty($path)) {
            throw new \RuntimeException('Falha ao salvar a foto do usuário no S3.');
        }

        return $path;
    }

    public function replace(?string $oldPath, UploadedFile $newPhoto): string
    {
        if ($oldPath && Storage::disk('s3')->exists($oldPath)) {
            Storage::disk('s3')->delete($oldPath);
        }

        return $this->upload($newPhoto);
    }
}

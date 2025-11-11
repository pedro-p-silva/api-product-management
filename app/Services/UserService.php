<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Events\UserCreatedEvent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected SnsPublisherService $snsPublisher,
        protected UserImageService $userImageService
    )
    {}

    public function get(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getById(int $id): Model
    {
        return $this->userRepository->getById($id);
    }

    public function create(array $data): Model
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo_path'] = $this->userImageService->upload($data['photo']);
        }

        unset($data['photo']);

        $user = $this->userRepository->create($data);

        if (isset($data['photo_path'])) {
            event(new UserCreatedEvent($user));
        }

        return $user;
    }

    public function update(int $id, array $data): bool
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo_path'] = $this->userImageService->replace(Auth::user()->photo_path, $data['photo']);
        }

        unset($data['photo']);

        return $this->userRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}

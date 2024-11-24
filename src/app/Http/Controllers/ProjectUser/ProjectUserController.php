<?php

namespace App\Http\Controllers\ProjectUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUser\StoreProjectUserRequest;
use App\Usecase\ProjectUser\DeleteProjectUserUsecaseInterface;
use App\Usecase\ProjectUser\StoreProjectUserUsecaseInterface;

class ProjectUserController extends Controller
{
    public function __construct(
        private readonly StoreProjectUserUsecaseInterface $storeProjectUserUsecase,
        private readonly DeleteProjectUserUsecaseInterface $deleteProjectUserUsecase,
    ) {
    }

    public function store(StoreProjectUserRequest $request)
    {
        $this->storeProjectUserUsecase->execute($request->getParams());
    }

    public function destroy(string $projectId, string $userId)
    {
        $this->deleteProjectUserUsecase->execute($projectId, $userId);
    }
}

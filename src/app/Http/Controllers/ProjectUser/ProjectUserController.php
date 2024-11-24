<?php

namespace App\Http\Controllers\ProjectUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUser\StoreProjectUserRequest;
use App\Usecase\ProjectUser\StoreProjectUserUsecaseInterface;

class ProjectUserController extends Controller
{
    public function __construct(
        private readonly StoreProjectUserUsecaseInterface $storeProjectUserUsecase,
    ) {
    }

    public function store(StoreProjectUserRequest $request)
    {
        $this->storeProjectUserUsecase->execute($request->getParams());
    }
}

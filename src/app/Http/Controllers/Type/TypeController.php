<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;
use App\Http\Requests\Type\StoreTypeRequest;
use App\Usecase\Type\DeleteTypeUsecaseInterface;
use App\Usecase\Type\StoreTypeUsecaseInterface;

class TypeController extends Controller
{
    public function __construct(
        private readonly StoreTypeUsecaseInterface $storeTypeUsecase,
        private readonly DeleteTypeUsecaseInterface $deleteTypeUsecase
    ) {
    }

    public function store(StoreTypeRequest $request)
    {
        $this->storeTypeUsecase->execute($request->getParams());
    }

    public function destroy(string $projectId, int $typId)
    {
        $this->deleteTypeUsecase->execute($projectId, $typId);
    }
}

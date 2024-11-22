<?php

namespace App\Http\Controllers\Priority;

use App\Http\Controllers\Controller;
use App\Http\Requests\Priority\StorePriorityRequest;
use App\Usecase\Priority\DeletePriorityUsecaseInterface;
use App\Usecase\Priority\StorePriorityUsecaseInterface;

class PriorityController extends Controller
{
    public function __construct(
        private readonly StorePriorityUsecaseInterface $storePriorityUsecase,
        private readonly DeletePriorityUsecaseInterface $deletePriorityUsecase
    ) {
    }

    public function store(StorePriorityRequest $request)
    {
        $this->storePriorityUsecase->execute($request->getParams());
    }

    public function destroy(string $projectId, int $priorityId)
    {
        $this->deletePriorityUsecase->execute($projectId, $priorityId);
    }
}

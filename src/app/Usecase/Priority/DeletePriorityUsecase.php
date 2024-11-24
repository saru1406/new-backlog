<?php

declare(strict_types=1);

namespace App\Usecase\Priority;

use App\Repositories\Priority\PriorityRepositoryInterface;

class DeletePriorityUsecase implements DeletePriorityUsecaseInterface
{
    public function __construct(
        private readonly PriorityRepositoryInterface $priorityRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectId, int $priorityId): void
    {
        $isPriority = $this->priorityRepository->existsPriority($priorityId);
        if ($isPriority) {
            $this->priorityRepository->deletePriority($priorityId);
        }
    }
}

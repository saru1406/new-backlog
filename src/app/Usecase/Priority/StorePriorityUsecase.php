<?php

declare(strict_types=1);

namespace App\Usecase\Priority;

use App\Repositories\Priority\PriorityRepositoryInterface;
use App\Repositories\Priority\StorePriorityParams;

class StorePriorityUsecase implements StorePriorityUsecaseInterface
{
    public function __construct(
        private readonly PriorityRepositoryInterface $priorityRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(StorePriorityParams $params): void
    {
        $this->priorityRepository->storePriority($params->toArray());
    }
}

<?php

declare(strict_types=1);

namespace App\Usecase\ProjectUser;

use App\Repositories\ProjectUser\ProjectUserRepositoryInterface;

class DeleteProjectUserUsecase implements DeleteProjectUserUsecaseInterface
{
    public function __construct(
        private readonly ProjectUserRepositoryInterface $projectUserRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectId, string $userId): void
    {
        $projectUser = $this->projectUserRepository->findProjectUser($projectId, $userId);
        $this->projectUserRepository->deleteProjectUser($projectUser->id);
    }
}

<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use App\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StoreProjectUsecase implements StoreProjectUsecaseInterface
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectNae): void
    {
        $user = Auth::user();

        $this->projectRepository->storeProject(['company_id' => $user->company_id, 'project_name' => $projectNae]);
    }
}

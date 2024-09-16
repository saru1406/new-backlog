<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use App\Models\Project;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Support\Facades\Auth;

class ShowProjectUsecase implements ShowProjectUsecaseInterface
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly ProjectServiceInterface $projectService,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectId): Project
    {
        $user = Auth::user();

        return $this->projectService->fetchProject($user, $projectId);
    }
}

<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class IndexProjectUsecase implements IndexProjectUsecaseInterface
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly CompanyRepositoryInterface $companyRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(): Collection
    {
        $user = Auth::user();

        return $this->projectRepository->projectByCompanyId($user->company_id);
    }
}

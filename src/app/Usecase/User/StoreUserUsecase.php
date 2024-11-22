<?php

declare(strict_types=1);

namespace App\Usecase\User;

use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\user\StoreUserParams;

class StoreUserUsecase implements StoreUserUsecaseInterface
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly CompanyRepositoryInterface $companyRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(StoreUserParams $params): void
    {
        $this->projectRepository->projectByCompanyId($params->toArray());
    }
}

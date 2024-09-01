<?php

namespace App\Usecase\Company;

use App\Exceptions\AlreadyExistsException;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Company\CompanyServiceInterface;
use Auth;

class StoreCompanyUsecase implements StoreCompanyUsecaseInterface
{
    public function __construct(
        private readonly CompanyServiceInterface $companyService,
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $name): void
    {
        $user = Auth::user();
        $domain = $this->companyService->getDomainByEmail($user->email);
        $this->checkDomain($domain);
        $company = $this->companyRepository->storeCompany([
            'company_name' => $name,
            'domain' => $domain,
        ]);
        $this->userRepository->updateUserCompanyId($company, $user->id);
    }

    /**
     * ドメインの存在を確認
     *
     * @param string $domain
     *
     * @throws AlreadyExistsException
     *
     * @return void
     */
    private function checkDomain(string $domain): void
    {
        $isDomain = $this->companyRepository->existsByDomain($domain);
        if ($isDomain) {
            throw new AlreadyExistsException($domain);
        }
    }
}

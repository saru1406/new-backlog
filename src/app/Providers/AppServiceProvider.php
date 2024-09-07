<?php

namespace App\Providers;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Usecase\Company\StoreCompanyUsecase;
use App\Usecase\Company\StoreCompanyUsecaseInterface;
use App\Usecase\Project\IndexProjectUsecase;
use App\Usecase\Project\IndexProjectUsecaseInterface;
use App\Usecase\Project\StoreProjectUsecase;
use App\Usecase\Project\StoreProjectUsecaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Company
        $this->app->bind(StoreCompanyUsecaseInterface::class, StoreCompanyUsecase::class);
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);

        // User
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        // Project
        $this->app->bind(IndexProjectUsecaseInterface::class, IndexProjectUsecase::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(StoreProjectUsecaseInterface::class, StoreProjectUsecase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

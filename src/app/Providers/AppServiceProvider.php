<?php

namespace App\Providers;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Project\ProjectService;
use App\Services\Project\ProjectServiceInterface;
use App\Services\Task\TaskService;
use App\Services\Task\TaskServiceInterface;
use App\Usecase\Company\StoreCompanyUsecase;
use App\Usecase\Company\StoreCompanyUsecaseInterface;
use App\Usecase\Project\IndexProjectUsecase;
use App\Usecase\Project\IndexProjectUsecaseInterface;
use App\Usecase\Project\ShowProjectUsecase;
use App\Usecase\Project\ShowProjectUsecaseInterface;
use App\Usecase\Project\StoreProjectUsecase;
use App\Usecase\Project\StoreProjectUsecaseInterface;
use App\Usecase\Task\BoardTaskUsecase;
use App\Usecase\Task\BoardTaskUsecaseInterface;
use App\Usecase\Task\StoreTaskUsecase;
use App\Usecase\Task\StoreTaskUsecaseInterface;
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
        $this->app->bind(ShowProjectUsecaseInterface::class, ShowProjectUsecase::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);

        // Task
        $this->app->bind(StoreTaskUsecaseInterface::class, StoreTaskUsecase::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(BoardTaskUsecaseInterface::class, BoardTaskUsecase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Priority\PriorityRepository;
use App\Repositories\Priority\PriorityRepositoryInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\ProjectUser\ProjectUserRepository;
use App\Repositories\ProjectUser\ProjectUserRepositoryInterface;
use App\Repositories\State\StateRepository;
use App\Repositories\State\StateRepositoryInterface;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Type\TypeRepository;
use App\Repositories\Type\TypeRepositoryInterface;
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
use App\Usecase\Priority\DeletePriorityUsecase;
use App\Usecase\Priority\DeletePriorityUsecaseInterface;
use App\Usecase\Priority\StorePriorityUsecase;
use App\Usecase\Priority\StorePriorityUsecaseInterface;
use App\Usecase\Project\IndexProjectUsecase;
use App\Usecase\Project\IndexProjectUsecaseInterface;
use App\Usecase\Project\SettingProjectUsecase;
use App\Usecase\Project\SettingProjectUsecaseInterface;
use App\Usecase\Project\ShowProjectUsecase;
use App\Usecase\Project\ShowProjectUsecaseInterface;
use App\Usecase\Project\StoreProjectUsecase;
use App\Usecase\Project\StoreProjectUsecaseInterface;
use App\Usecase\ProjectUser\DeleteProjectUserUsecase;
use App\Usecase\ProjectUser\DeleteProjectUserUsecaseInterface;
use App\Usecase\ProjectUser\StoreProjectUserUsecase;
use App\Usecase\ProjectUser\StoreProjectUserUsecaseInterface;
use App\Usecase\Task\BoardTaskUsecase;
use App\Usecase\Task\BoardTaskUsecaseInterface;
use App\Usecase\Task\CreateTaskUsecase;
use App\Usecase\Task\CreateTaskUsecaseInterface;
use App\Usecase\Task\FetchTaskBoardUsecase;
use App\Usecase\Task\FetchTaskBoardUsecaseInterface;
use App\Usecase\Task\GanttTaskUsecase;
use App\Usecase\Task\GanttTaskUsecaseInterface;
use App\Usecase\Task\IndexTaskUsecase;
use App\Usecase\Task\IndexTaskUsecaseInterface;
use App\Usecase\Task\StoreTaskUsecase;
use App\Usecase\Task\StoreTaskUsecaseInterface;
use App\Usecase\Type\DeleteTypeUsecase;
use App\Usecase\Type\DeleteTypeUsecaseInterface;
use App\Usecase\Type\StoreTypeUsecase;
use App\Usecase\Type\StoreTypeUsecaseInterface;
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

        // ProjectUser
        $this->app->bind(StoreProjectUserUsecaseInterface::class, StoreProjectUserUsecase::class);
        $this->app->bind(DeleteProjectUserUsecaseInterface::class, DeleteProjectUserUsecase::class);
        $this->app->bind(ProjectUserRepositoryInterface::class, ProjectUserRepository::class);

        // Project
        $this->app->bind(IndexProjectUsecaseInterface::class, IndexProjectUsecase::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(StoreProjectUsecaseInterface::class, StoreProjectUsecase::class);
        $this->app->bind(ShowProjectUsecaseInterface::class, ShowProjectUsecase::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(SettingProjectUsecaseInterface::class, SettingProjectUsecase::class);

        // Task
        $this->app->bind(StoreTaskUsecaseInterface::class, StoreTaskUsecase::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(BoardTaskUsecaseInterface::class, BoardTaskUsecase::class);
        $this->app->bind(IndexTaskUsecaseInterface::class, IndexTaskUsecase::class);
        $this->app->bind(CreateTaskUsecaseInterface::class, CreateTaskUsecase::class);

        // Board
        $this->app->bind(FetchTaskBoardUsecaseInterface::class, FetchTaskBoardUsecase::class);

        // Gantt
        $this->app->bind(GanttTaskUsecaseInterface::class, GanttTaskUsecase::class);

        // State
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);

        // Priority
        $this->app->bind(PriorityRepositoryInterface::class, PriorityRepository::class);
        $this->app->bind(StorePriorityUsecaseInterface::class, StorePriorityUsecase::class);
        $this->app->bind(DeletePriorityUsecaseInterface::class, DeletePriorityUsecase::class);

        // Type
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(StoreTypeUsecaseInterface::class, StoreTypeUsecase::class);
        $this->app->bind(DeleteTypeUsecaseInterface::class, DeleteTypeUsecase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

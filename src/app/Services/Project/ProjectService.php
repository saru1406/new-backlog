<?php

declare(strict_types=1);

namespace App\Services\Project;

use App\Models\Project;
use App\Models\User;
use App\Repositories\Project\ProjectRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ProjectService implements ProjectServiceInterface
{
    public function __construct(private readonly ProjectRepositoryInterface $projectRepository)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function fetchProject(User $user, string $projectId): Project
    {
        $project = $this->projectRepository->findProject($projectId, ['id', 'company_id', 'project_name'], ['users:id,name,email']);
        $this->checkProjectByCompany($user, $project);

        return $project;
    }

    /**
     * プロジェクトの企業IDとユーザーの企業IDの一致確認
     *
     * @param User $user
     * @param Project $project
     *
     * @throws AccessDeniedHttpException
     *
     * @return void
     */
    private function checkProjectByCompany(User $user, Project $project): void
    {
        if ($user->company_id === $project->company_id) {
            return;
        }
        throw new AccessDeniedHttpException('アクセス権限がありません');
    }
}

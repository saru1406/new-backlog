<?php

declare(strict_types=1);

namespace App\Usecase\ProjectUser;

use App\Repositories\ProjectUser\ProjectUserRepositoryInterface;
use App\Repositories\ProjectUser\StoreProjectUserParams;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

class StoreProjectUserUsecase implements StoreProjectUserUsecaseInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ProjectUserRepositoryInterface $projectUserRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(StoreProjectUserParams $params): void
    {
        $user = $this->userRepository->firstUserByEmail($params->userEmail);
        $this->projectUserRepository->storeProjectUser(['project_id' => $params->projectId, 'user_id' => $user->id]);
    }
}

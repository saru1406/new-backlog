<?php

declare(strict_types=1);

namespace App\Usecase\Type;

use App\Repositories\Type\TypeRepositoryInterface;

class DeleteTypeUsecase implements DeleteTypeUsecaseInterface
{
    public function __construct(
        private readonly TypeRepositoryInterface $typeRepository
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectId, int $typeId): void
    {
        $isType = $this->typeRepository->existsType($typeId);
        if ($isType) {
            $this->typeRepository->deleteType($typeId);
        }
    }
}

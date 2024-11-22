<?php

declare(strict_types=1);

namespace App\Usecase\Type;

use App\Repositories\Type\StoreTypeParams;
use App\Repositories\Type\TypeRepositoryInterface;

class StoreTypeUsecase implements StoreTypeUsecaseInterface
{
    public function __construct(
        private readonly TypeRepositoryInterface $typeRepository
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(StoreTypeParams $params): void
    {
        $this->typeRepository->storeType($params->toArray());
    }
}

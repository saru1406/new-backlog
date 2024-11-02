<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FetchTaskBoardRequest;
use App\Usecase\Task\FetchTaskBoardUsecaseInterface;

class FetchTaskBoardController extends Controller
{
    public function __construct(private readonly FetchTaskBoardUsecaseInterface $fetchTaskBoardUsecase)
    {
    }

    public function __invoke(FetchTaskBoardRequest $request)
    {
        $data = $this->fetchTaskBoardUsecase->execute($request->getParams());

        return response()->json($data, 200);
    }
}

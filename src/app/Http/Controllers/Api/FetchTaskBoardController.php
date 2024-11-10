<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FetchTaskBoardRequest;
use App\Usecase\Task\FetchTaskBoardUsecaseInterface;
use Illuminate\Support\Facades\Log;

class FetchTaskBoardController extends Controller
{
    public function __construct(private readonly FetchTaskBoardUsecaseInterface $fetchTaskBoardUsecase)
    {
    }

    public function __invoke(FetchTaskBoardRequest $request)
    {
        $data = $this->fetchTaskBoardUsecase->execute($request->getParams());
        Log::info($data);

        return response()->json($data, 200);
    }
}

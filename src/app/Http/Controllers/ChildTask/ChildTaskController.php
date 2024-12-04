<?php

namespace App\Http\Controllers\ChildTask;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildTask\StoreChildTaskRequest;
use App\Http\Requests5\ChildTask\UpdateChildTaskRequest;
use App\Models\ChildTask;
use App\Usecase\ChildTask\StoreChildTaskUsecaseInterface;

class ChildTaskController extends Controller
{
    public function __construct(
        private readonly StoreChildTaskUsecaseInterface $storeChildTaskUsecase,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChildTaskRequest $request)
    {
        $this->storeChildTaskUsecase->execute($request->getParams());
    }

    /**
     * Display the specified resource.
     */
    public function show(ChildTask $childTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChildTask $childTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildTaskRequest $request, ChildTask $childTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildTask $childTask)
    {
        //
    }
}

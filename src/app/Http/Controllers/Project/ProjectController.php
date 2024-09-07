<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Usecase\Project\IndexProjectUsecaseInterface;
use App\Usecase\Project\StoreProjectUsecaseInterface;
use App\ViewModels\ProjectIndexViewModel;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __construct(private readonly IndexProjectUsecaseInterface $indexProjectUsecase, private readonly StoreProjectUsecaseInterface $storeProjectUsecase)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->indexProjectUsecase->execute();

        return Inertia::render('Project/Index', ['projects' => (new ProjectIndexViewModel($projects))->render()]);
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
    public function store(StoreProjectRequest $request)
    {
        $this->storeProjectUsecase->execute($request->getProject_name());
        $projects = $this->indexProjectUsecase->execute();

        return Inertia::render('Project/Index', [
            'message' => 'プロジェクトが作成されました',
            'projects' => (new ProjectIndexViewModel($projects))->render(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Usecase\Project\IndexProjectUsecaseInterface;
use App\Usecase\Project\SettingProjectUsecaseInterface;
use App\Usecase\Project\ShowProjectUsecaseInterface;
use App\Usecase\Project\StoreProjectUsecaseInterface;
use App\ViewModels\Project\SettingProjectViewModel;
use App\ViewModels\ProjectIndexViewModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function __construct(
        private readonly IndexProjectUsecaseInterface $indexProjectUsecase,
        private readonly StoreProjectUsecaseInterface $storeProjectUsecase,
        private readonly ShowProjectUsecaseInterface $showProjectUsecase,
        private readonly SettingProjectUsecaseInterface $settingProjectUsecase,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->indexProjectUsecase->execute();

        return Inertia::render('Project/Index', [
            'projects' => (new ProjectIndexViewModel($projects))->render(),
            'message' => session('message'),
        ]);
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
        try {
            DB::transaction(function () use ($request, &$projects) {
                $projects = $this->storeProjectUsecase->execute($request->getProject_name());
            });
        } catch (Exception $e) {
            Log::error('プロジェクト作成中にエラーが発生しました: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return to_route('projects.index', [
            'projects' => (new ProjectIndexViewModel($projects))->render(),
        ])->with('message', 'プロジェクトが作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $projectId)
    {
        $project = $this->showProjectUsecase->execute($projectId);

        return Inertia::render('Project/Show', ['project' => $project]);
    }

    public function setting(string $projectId)
    {
        $data = $this->settingProjectUsecase->execute($projectId);
        $formatData = new SettingProjectViewModel($data);

        return Inertia::render('Project/Setting', [
            'project' => $formatData->project,
            'users' => $formatData->users,
            'company_users' => $formatData->companyUsers,
            'states' => $formatData->states,
            'types' => $formatData->types,
            'priorities' => $formatData->priorities,
        ]);
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

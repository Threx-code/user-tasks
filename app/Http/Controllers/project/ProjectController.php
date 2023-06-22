<?php

namespace App\Http\Controllers\project;

use App\Contracts\ProjectInterface;
use App\Contracts\TaskInterface;
use App\Http\Requests\project\ProjectCreateRequest;
use App\Http\Requests\project\ProjectDeleteRequest;
use App\Http\Requests\project\ProjectUpdateRequest;
use App\Http\Requests\tasks\DeleteTaskRequest;
use App\Http\Requests\tasks\UpdateTaskRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController
{

//private ProjectInterface $projectRepository;

    public function __construct(private ProjectInterface $projectRepository){}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        return view('projects.index');
    }

    public function getAllProjects(Request $request): Factory|View|Application
    {
        $projects = $this->projectRepository->getAllProjects($request);
        return view('projects.all-projects', compact('projects'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getAProject(Request $request): View|Factory|Application
    {
        $project = $this->projectRepository->getAProject($request);
        return view('projects.project', compact('project'));
    }

    /**
     * @param ProjectCreateRequest $request
     * @return mixed
     */
    public function store(ProjectCreateRequest $request): mixed
    {
        return $this->projectRepository->createProject($request);

    }

    /**
     * @param ProjectUpdateRequest $request
     * @return mixed
     */
    public function update(ProjectUpdateRequest $request): mixed
    {
        return $this->projectRepository->editProject($request);
    }

    /**
     * @param ProjectDeleteRequest $request
     * @return mixed
     */
    public function delete(ProjectDeleteRequest $request): mixed
    {
        return $this->projectRepository->deleteProject($request);
    }


}


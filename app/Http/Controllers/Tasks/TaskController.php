<?php

namespace App\Http\Controllers\Tasks;

use App\Contracts\ProjectInterface;
use App\Contracts\TaskInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\tasks\DeleteTaskRequest;
use App\Http\Requests\tasks\TaskCreateRequest;
use App\Http\Requests\tasks\UpdateTaskRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //private TaskInterface $taskRepository;

    public function __construct(private TaskInterface $taskRepository, private ProjectInterface $projectRepository){}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $projects = $this->projectRepository->getAllProjects($request);
        return view('tasks.index', compact('projects'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function allTasks(Request $request): View|Factory|Application
    {
        $tasks = $this->taskRepository->getAllTasks($request);
        $projects = $this->projectRepository->getAllProjects($request);

        return view('tasks.all-tasks', compact('tasks', 'projects'));
    }

    public function getAProjectTasks(Request $request)
    {
        $tasks = $this->taskRepository->getAProjectTasks($request);
        return view('tasks.specific-project', compact('tasks'));
    }

    /**
     * @param TaskCreateRequest $request
     * @return mixed
     */
    public function store(TaskCreateRequest $request): mixed
    {
        return $this->taskRepository->createTask($request);

    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getATask(Request $request): View|Factory|Application
    {
        $task = $this->taskRepository->getATask($request);
        $projects = $this->projectRepository->getAllProjects($request);
        return view('tasks.task', compact('task', 'projects'));
    }

    /**
     * @param UpdateTaskRequest $request
     * @return mixed
     */
    public function update(UpdateTaskRequest $request): mixed
    {
        return $this->taskRepository->editTask($request);
    }

    /**
     * @param DeleteTaskRequest $request
     * @return mixed
     */
    public function delete(DeleteTaskRequest $request): mixed
    {
        return $this->taskRepository->deleteTask($request);
    }


}

<?php

namespace App\Services;

use App\Contracts\TaskServiceInterface;
use App\Helpers\TaskHelper;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService implements TaskServiceInterface
{
    /**
     * @param TaskHelper $helper
     * @param Task $task
     */
    public function __construct(private readonly TaskHelper $helper, private readonly Task $task){}

    /**
     * @param $request
     * @return mixed
     */
    public function getATask($request): mixed
    {
        $whereRaw = $this->filterByName($request->name);
        $where = [
            'id' => $request->id
        ];
        $with = ['projects' => function($query){
            $query->where('date_deleted', NULL);
        }];
        return $this->helper->getADataAndChild($this->task, $where, $whereRaw, $with);
    }

    /**
     * @param $request
     * @return LengthAwarePaginator
     */
    public function getAllTasks($request): LengthAwarePaginator
    {
        $whereRaw = $this->filterByName($request->name);
        $where = [
            'date_deleted' => NULL
        ];
        $with = ['projects' => function($query){
            $query->where('date_deleted', NULL);
        }];

        return $this->helper->getAllData($this->task, $where, $whereRaw, $with);

    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAProjectTasks($request): mixed
    {
        $whereRaw = $this->filterByName($request->name);
        $where = [
            'date_deleted' => NULL,
            'project_id' => $request->project_id
        ];
        $with = ['projects' => function($query){
            $query->where('date_deleted', NULL);
        }];

        return $this->helper->getAllData($this->task, $where, $whereRaw, $with);

    }

    /**
     * @param $projectName
     * @return string
     */
    private function filterByName($projectName): string
    {
        if(!empty($projectName)) {
            $orderDate = "WHERE name = '{$projectName}' ";
        }
        return $orderDate ?? 'id IS NOT NULL';
    }

    /**
     * @param $request
     * @param string $response
     * @return mixed|string
     * @throws Exception
     */
    public function createTask($request, string $response = 'Sorry could not create task'): mixed
    {
        $name = ucwords($request->name);
        $data = [
            'name' => $name,
            'priority' => $request->priority,
            'project_id' => $request->project_id
        ];

        if($this->helper->dataCreator($this->task, $data)){
            $response = "Task created successfully";
        }

        return $response;
    }

    /**
     * @param $request
     * @param string $response
     * @return string
     */
    public function editTask($request, string $response = 'Sorry could not edit this task'): string
    {
        $whereClause = [
            'id' => $request->task_id ,
            'date_deleted' => NULL
        ];

        $name = ucwords($request->name);
        $data = [
            'name' => $name,
            'priority' => $request->priority,
            'project_id' => $request->project_id
        ];

        $taskToEdit = $this->helper->update($this->task, $whereClause, $data);
        if($taskToEdit){
            $response = 'Task updated successfully';
        }
        return $response;
    }

    /**
     * @param $request
     * @param string $response
     * @return string
     */
    public function deleteTask($request, string $response = 'Sorry could not delete this task'): string
    {
        $whereClause = [
            'id' => $request->task_id ,
            'date_deleted' => NULL
        ];
        $taskToDelete = $this->helper->getAData($this->task, $whereClause);

        if($taskToDelete){
            $taskToDelete->date_deleted = Carbon::now();
            $taskToDelete->save();
            $response = 'Task deleted successfully';
        }
        return $response;
    }

}

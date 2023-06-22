<?php

namespace App\Services;

use App\Contracts\ProjectServiceInterface;
use App\Helpers\TaskHelper;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService implements ProjectServiceInterface
{
    /**
     * @param TaskHelper $helper
     * @param Project $project
     */
    public function __construct(private readonly TaskHelper $helper, private readonly Project $project){}

    /**
     * @param $request
     * @return mixed
     */
    public function getAProject($request): mixed
    {
        $whereRaw = $this->filterByName($request->name);
        $where = [
            'id' => $request->id
        ];
        $with = ['tasks' => function($query){
            $query->where('date_deleted', NULL);
        }];
        return $this->helper->getADataAndChild($this->project, $where, $whereRaw, $with);
    }

    /**
     * @param $request
     * @return LengthAwarePaginator
     */
    public function getAllProjects($request): LengthAwarePaginator
    {
        $whereRaw = $this->filterByName($request->name);
        $where = [
            'date_deleted' => NULL
        ];
        $with = ['tasks' => function($query){
            $query->where('date_deleted', NULL);
        }];

        return $this->helper->getAllData($this->project, $where, $whereRaw, $with);
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
     * @return string
     */
    public function createProject($request, string $response = 'Sorry could not create project'): string
    {
        $name = ucwords($request->name);
        $data = [
            'name' => $name
        ];
        if($this->helper->dataCreator($this->project, $data)){
            $response = "Project created successfully";
        }

        return $response;
    }

    /**
     * @param $request
     * @param string $response
     * @return string
     */
    public function editProject($request, string $response = 'Sorry could not edit this project'): string
    {
        $whereClause = [
            'id' => $request->product_id ,
            'date_deleted' => NULL
        ];

        $projectToEdit = $this->helper->getAData($this->project, $whereClause);

        if($projectToEdit){
            $projectToEdit->name = ucwords($request->name);
            $projectToEdit->save();
            $response = 'Project updated successfully';
        }
        return $response;
    }

    /**
     * @param $request
     * @param string $response
     * @return string
     */
    public function deleteProject($request, string $response = 'Sorry could not delete this project'): string
    {
         $whereClause = [
            'id' => $request->project_id ,
            'date_deleted' => NULL
        ];

        $projectToDelete = $this->helper->getAData($this->project, $whereClause);
        if($projectToDelete){
            $projectToDelete->date_deleted = Carbon::now();
            $projectToDelete->save();

            Task::where('project_id', $projectToDelete->id)->update([
                'date_deleted' => Carbon::now()
            ]);
            $response = 'Project deleted successfully';
        }
        return $response;
    }

}


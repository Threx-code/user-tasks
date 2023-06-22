<?php

namespace App\Repositories;

use App\Contracts\TaskInterface;
use App\Contracts\TaskServiceInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskInterface
{
    /**
     * @param TaskServiceInterface $service
     */
    public function __construct(private readonly TaskServiceInterface $service){
    }

    /**
     * @param $request
     * @return mixed|string
     * @throws Exception
     */
    public function createTask($request): mixed
    {
        return $this->service->createTask($request);
    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function editTask($request): string
    {
        return $this->service->editTask($request);
    }

    /**
     * @param $request
     * @return string
     */
    public function deleteTask($request): string
    {
        return $this->service->deleteTask($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getATask($request): mixed
    {
        return $this->service->getATask($request);
    }

    /**
     * @param $request
     * @return LengthAwarePaginator
     */
    public function getAllTasks($request): LengthAwarePaginator
    {
        return $this->service->getAllTasks($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAProjectTasks($request): mixed
    {
        return $this->service->getAProjectTasks($request);
    }
}

<?php

namespace App\Repositories;

use App\Contracts\ProjectInterface;
use App\Contracts\ProjectServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectInterface
{
    public function __construct(private readonly ProjectServiceInterface $service){}

    /**
     * @param $request
     * @return string
     */
    public function createProject($request): string
    {
        return $this->service->createProject($request);
    }

    /**
     * @param $request
     * @return string
     */
    public function editProject($request): string
    {
        return $this->service->editProject($request);
    }

    /**
     * @param $request
     * @return string
     */
    public function deleteProject($request): string
    {
        return $this->service->deleteProject($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAProject($request): mixed
    {
        return $this->service->getAProject($request);
    }

    /**
     * @param $request
     * @return LengthAwarePaginator
     */
    public function getAllProjects($request): LengthAwarePaginator
    {
        return $this->service->getAllProjects($request);
    }
}

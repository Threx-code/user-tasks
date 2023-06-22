<?php

namespace App\Contracts;

interface TaskInterface
{
    public function createTask($request);
    public function editTask($request);
    public function deleteTask($request);
    public function getATask($request);
    public function getAllTasks($request);
    public function getAProjectTasks($request);
}

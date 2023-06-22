<?php

namespace App\Contracts;

interface ProjectInterface
{
    public function createProject($request);
    public function editProject($request);
    public function deleteProject($request);
    public function getAProject($request);
    public function getAllProjects($request);
}

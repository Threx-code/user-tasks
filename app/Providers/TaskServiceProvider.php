<?php

namespace App\Providers;

use App\Contracts\TaskServiceInterface;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;
use App\Contracts\TaskInterface;
use App\Repositories\TaskRepository;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskInterface::class, TaskRepository::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

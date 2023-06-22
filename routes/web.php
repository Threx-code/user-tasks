<?php

use App\Http\Controllers\project\ProjectController;
use App\Http\Controllers\Tasks\TaskController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [ProjectController::class, 'index'])->name('index');

Route::middleware([])->prefix('task')->group(function(){
    Route::get('/all-tasks', [TaskController::class, 'allTasks'])->name('task.all-tasks');
    Route::get('/create-task', [TaskController::class, 'index'])->name('task.create-task');
    Route::get('/edit/{id}', [TaskController::class, 'getATask'])->name('task.edit');
    Route::post('/project-tasks', [TaskController::class, 'getAProjectTasks'])->name('task.project-tasks');

    Route::post('/store', [TaskController::class, 'store'])->name('task.store');
    Route::post('/update', [TaskController::class, 'update'])->name('task.update');
    Route::post('delete', [TaskController::class, 'delete'])->name('task.delete');

    Route::get('/project/all-projects', [ProjectController::class, 'getAllProjects'])->name('tasks.project.all-projects');
    Route::get('/project/edit/{id}', [ProjectController::class, 'getAProject'])->name('tasks.project.edit');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('task.project.store');
    Route::post('/project/update', [ProjectController::class, 'update'])->name('task.project.update');
    Route::post('project/delete', [ProjectController::class, 'delete'])->name('task.project.delete');
}
);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\projectsController;
use App\Http\Controllers\Api\tasksController;

//RUTAS DE PROYECTOS
Route::get('/projects', [projectsController::class, 'index'] );

Route::post('/projects', [projectsController::class, 'crear']);

Route::get('/projects/{id}',[projectsController::class, 'mostrar'] );

Route::put('/projects/{id}',[projectsController::class, 'actualizar'] );

Route::delete('/projects/{id}', [projectsController::class, 'eliminar']);

//RUTAS DE TAREAS

Route::get('/tasks', [tasksController::class, 'index'] );

Route::post('/tasks', [tasksController::class, 'crear']);

Route::get('/tasks/{id}',[tasksController::class, 'mostrar'] );

Route::put('/tasks/{id}',[tasksController::class, 'actualizar'] );

Route::delete('/tasks/{id}', [tasksController::class, 'eliminar']);



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\projectsController;

//RUTAS DE PROYECTOS
Route::get('/projects', [projectsController::class, 'index'] );

Route::post('/projects', [projectsController::class, 'crear']);

Route::get('/projects/{id}',[projectsController::class, 'mostrar'] );

Route::put('/projects/{id}',[projectsController::class, 'actualizar'] );

Route::delete('/projects/{id}', [projectsController::class, 'eliminar']);

//RUTAS DE TAREAS

Route::get('/tasks', function () {
    return 'Listado de tareas con filtros';
});

Route::post('/tasks', function () {
    return 'Creando tareas';
});

Route::get('/tasks/{id}', function () {
    return 'Detalle del tareas';
});

Route::put('/tasks/{id}', function () {
    return 'Actualizando el tareas';
});

Route::delete('/tasks/{id}', function () {
    return 'Eliminando el tareas';
});


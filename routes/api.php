<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ProgresoUsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\ResolverActividadController;

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
Route::get('/contenidos', [ContenidoController::class, 'index']);
Route::post('/contenidos', [ContenidoController::class, 'store']);
Route::put('/contenidos/{id}', [ContenidoController::class, 'update']);
Route::delete('/contenidos/{id}', [ContenidoController::class, 'destroy']);
Route::get('/actividades', [ActividadController::class, 'index']);
Route::post('/actividades', [ActividadController::class, 'store']);
Route::put('/actividades/{id}', [ActividadController::class, 'update']);
Route::delete('/actividades/{id}', [ActividadController::class, 'destroy']);
Route::get('/progreso', [ProgresoUsuarioController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/preguntas', [PreguntaController::class, 'index']);
Route::post('/preguntas', [PreguntaController::class, 'store']);
Route::put('/preguntas/{id}', [PreguntaController::class, 'update']);
Route::delete('/preguntas/{id}', [PreguntaController::class, 'destroy']);
Route::get('/actividades/{id}/preguntas', [ResolverActividadController::class, 'obtenerPreguntas']);
Route::post('/resolver-actividad', [ResolverActividadController::class, 'resolver']);
Route::get('/progreso/usuario/{id}', [ProgresoUsuarioController::class, 'mostrarPorUsuario']);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificacionController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\CorrectivoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/verificacion/{id}/departamento', [VerificacionController::class, 'byDepartament']); 
Route::get('/orden/{id}/departamento', [OrdenController::class, 'byDepartament']); 
Route::get('/orden/{id}/usuario', [OrdenController::class, 'byUser']); 
Route::get('/equipo/{id}/inventario', [CorrectivoController::class, 'byEquipo']); 
Route::get('/orden/{id}/refacion', [OrdenController::class, 'byRefaccion']); 
Route::get('/orden/{id}/material', [OrdenController::class, 'byMaterial']); 
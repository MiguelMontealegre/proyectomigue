<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Aqui por ejemplo simplemente ponemos la misma ruta que estaba en web, y el navegador va a mostrar lo mismo
// El api simplemente es una url adicional para que no acumulemos tanto codigo, Pero sucede que en las url api solo
// se recomiendan para mostrar una respuestas json 
// y crear una api ya sea movil o consumir el contenido de tu proyecto en otros proyectos con respuesta tipo json.

// Route::get('/nosotros', '\App\Http\Controllers\RecetaController');



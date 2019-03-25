<?php

use Illuminate\Http\Request;

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


Route::group([
    'prefix' => 'auth',
], function () {
    Route::get('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::get('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::get('productos','ProductoController@all');
    Route::resource('roles', 'RolController');
    Route::resource('user', 'UserController');
});

Route::group([
    'prefix' => 'tareas',
], function () {
    Route::post('listar', 'TareasCDSAH\TareaController@prueba');
    //listar todas las tareas de un usuario, por dia y por estado Pendiente
    Route::post('diario', 'TareasCDSAH\TareaController@tareasDiarias');
    //Listar todas las tareas de un usuario por dia y estado Finalizada
    Route::post('finalizado', 'TareasCDSAH\TareaController@tareasDiariasFinalizadas');
    //Listar todas las tareas de un usuario con estado No Cumplida
    Route::post('nada', 'TareasCDSAH\TareaController@tareasNoCumplidas');

    Route::post('insertar', 'TareasCDSAH\TareaController@insertarTarea');
    Route::post('editar', 'TareasCDSAH\TareaController@editarTarea');
    Route::post('editarEstado', 'TareasCDSAH\TareaController@editarEstadoTarea');

    Route::delete('eliminar', 'TareasCDSAH\TareaController@eliminarTarea');
    Route::get('buscar', 'TareasCDSAH\TareaController@buscarTareaPorId');

});

Route::group([
    'prefix' => 'reportes',
], function () {
    Route::get('listar', 'TareasCDSAH\ReporteController@index');
    Route::post('insertar', 'TareasCDSAH\ReporteController@store');

    // Route::get('diario', 'TareasCDSAH\TareaController@tareasDiarias');
    // Route::post('insertar', 'TareasCDSAH\TareaController@insertarTarea');
    // Route::post('editar', 'TareasCDSAH\TareaController@editarTarea');
    // Route::delete('eliminar', 'TareasCDSAH\TareaController@eliminarTarea');
    // Route::get('buscar', 'TareasCDSAH\TareaController@buscarTareaPorId');

});
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
    
    //listar todas las tareas de un usuario, por dia y por estado Pendiente ademas  ahora devuelve los reportes tambien
    Route::post('diario', 'TareasCDSAH\TareaController@tareasDiarias');

    //Ruta para insertar una nueva tarea
    Route::post('insertar', 'TareasCDSAH\TareaController@insertarTarea');


    //Ruta para editar tareas
    Route::post('editar', 'TareasCDSAH\TareaController@editarTarea');

    //Ruta para buscar tarea por id
    Route::get('buscar', 'TareasCDSAH\TareaController@buscarTareaPorId');


    //Ruta para cambiar el estado de una tarea de pendiente a terminada
    Route::post('editarEstado', 'TareasCDSAH\TareaController@editarEstadoTarea');


    //Ruta que invoca al metodo para eliminar una tarea
    Route::delete('eliminar', 'TareasCDSAH\TareaController@eliminarTarea');
    

    //Esta ruta es para actualizar el estado de pendiente a incumplida al dar click en el boton de generar reporte
    Route::post('prueba', 'TareasCDSAH\TareaController@editarEstadoTareaMultiple');

    //Esta ruta es para actulizar el estado de las tareas pendientes de dias atras que se ejecuta al cargar la pagina.
    Route::post('prueba2', 'TareasCDSAH\TareaController@editarEstadoTareaDiasAtras');


  
});

Route::group([
    'prefix' => 'reportes',
], function () {
    Route::post('listar', 'TareasCDSAH\ReporteController@index');
    Route::post('insertar', 'TareasCDSAH\ReporteController@store');
    Route::get('modificar', 'TareasCDSAH\ReporteController@edit');
    Route::post('anterior', 'TareasCDSAH\ReporteController@reporteAnterior');
});
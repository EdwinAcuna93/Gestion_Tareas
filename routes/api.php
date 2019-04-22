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
    Route::resource('roles', 'RolController');
    Route::resource('user', 'UserController');
});

Route::group([
    'prefix' => 'tareas',
], function () {
    
    //listar todas las tareas de un usuario, por dia y por estado Pendiente ademas  ahora devuelve los reportes tambien//alumno
    Route::get('tareasDiarias', 'TareasCDSAH\TareaController@tareasDiarias');

    //Ruta para insertar una nueva tarea //admin
    Route::post('insertarTarea', 'TareasCDSAH\TareaController@insertarTarea');


    //Ruta para editar tareas //admin
    Route::put('editarTarea', 'TareasCDSAH\TareaController@editarTarea');

    //Ruta para buscar tarea por id //admin
    Route::get('buscarTarea', 'TareasCDSAH\TareaController@buscarTareaPorId');


    //Ruta para cambiar el estado de una tarea de pendiente a terminada//alumno
    Route::put('editarEstado', 'TareasCDSAH\TareaController@editarEstadoTarea');


    //Ruta que invoca al metodo para eliminar una tarea //admin
    Route::delete('eliminarTarea', 'TareasCDSAH\TareaController@eliminarTarea');
    

    //Esta ruta es para actualizar el estado de pendiente a incumplida al dar click en el boton de generar reporte//alumno
    Route::put('editarEstadoMultiple', 'TareasCDSAH\TareaController@editarEstadoTareaMultiple');

    //Esta ruta es para actulizar el estado de las tareas pendientes de dias atras que se ejecuta al cargar la pagina.
    Route::put('editarEstadoDiasAtras', 'TareasCDSAH\TareaController@editarEstadoTareaDiasAtras');

    //Esta ruta es algo provisional //admin
    Route::get('usuarios', 'TareasCDSAH\TareaController@index');

   

});

Route::group([
    'prefix' => 'reportes',
], function () {
   
    //Ruta para buscar un reporte por id y poder cargar los datos en un form //admin
    Route::get('buscarReporte', 'TareasCDSAH\ReporteController@buscarReportePorId');
      // Route::post('listar', 'TareasCDSAH\ReporteController@index');
      //alumno
     Route::post('insertar', 'TareasCDSAH\ReporteController@store');
     //admin
     Route::put('modificarReporte', 'TareasCDSAH\ReporteController@update');
});
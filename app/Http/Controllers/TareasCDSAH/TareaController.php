<?php

namespace App\Http\Controllers\TareasCDSAH;

use Illuminate\Http\Request;

use App\Model\TareasCDSAH\Tarea;
use  App\Http\Controllers\Controller;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tarea::all();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function prueba()
    {
        $dato= Tarea::all();
        return response()->json(["tarea"=>$dato]);
        

    }

    public function tareasDiarias(request $request){
        $tareas = Tarea::where('users_id', $request->id )->where('fechaFin', $request->fecha )->get(); 
        return response()->json(["tarea"=>$tareas]);
    }


    public function insertarTarea(request $request){
    //Creamos una instancia del modelo
    $Tarea = new Tarea;
    //Esto accede a la propiedades de la tarea y lo inserta lo que viene en la data que es un arreglo asociativo  entonces se accede a la propiedad que se quiere
    $Tarea->tituloTarea=$request->titulo; //campos del json
    $Tarea->prioridad=$request->prioridad;
    $Tarea->descripcion=$request->descripcion;
    $Tarea->estado=$request->estado;
    $Tarea->fechaInicio->$request->fechaInicio;
    $Tarea->fechaFin->$request->fechaFin;
    $Tarea->horaInicio->$request->horaInicio;
    $Tarea->horaFin->$request->horaFin;

    //Guardamos en la bd
    $Tarea->save();

    }
}

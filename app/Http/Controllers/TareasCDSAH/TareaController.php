<?php

namespace App\Http\Controllers\TareasCDSAH;

use Illuminate\Http\Request;

use App\Model\TareasCDSAH\Tarea;
use  App\Http\Controllers\Controller;
use App\User;
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

    public function tareasDiariasPendientes(Request $request){
        $tareas = Tarea::where('users_id', $request->users_id )->where('fechaFin', $request->fechaFin )->where('estado', 'Pendiente' )->get(); 
        return response()->json(["tarea"=>$tareas]);
    }

    public function tareasDiariasFinalizadas(Request $request){
        $tareas = Tarea::where('users_id', $request->users_id )->where('fechaFin', $request->fechaFin )->where('estado', 'Finalizada' )->get(); 
        return response()->json(["tarea"=>$tareas]);
    }

    public function tareasNoCumplidas(Request $request){
        $tareas = Tarea::where('users_id', $request->users_id )->where('estado', 'No Cumplida' )->where('fechaFin', $request->fechaFin )->get(); 
        return response()->json(["tarea"=>$tareas]);
    }

    


    public function buscarTareaPorId(Request $request){
        $tarea = Tarea::where('id', $request->id )->get(); 
        return response()->json(["tarea"=>$tarea]);
    }

    
    public function insertarTarea(request $request){
    //Creamos una instancia del modelo
    $Tarea = new Tarea;
    //Esto accede a la propiedades de la tarea y lo inserta lo que viene en la data que es un arreglo asociativo  entonces se accede a la propiedad que se quiere
    $Tarea->tituloTarea=$request->tituloTarea; //campos del json
    $Tarea->prioridad=$request->prioridad;
    $Tarea->descripcion=$request->descripcion;
    $Tarea->estado=$request->estado;
    $Tarea->fechaInicio=$request->fechaInicio;
    $Tarea->fechaFin=$request->fechaFin;
    $Tarea->horaInicio=$request->horaInicio;
    $Tarea->horaFin=$request->horaFin;
    $Tarea->users_id=$request->users_id;

    try {
        $Tarea->save();
        return response()->json("registro insertado");
    }catch (\Throwable $th) {
        return response()->json("registro no insertado");
    }
    //Forma de retornar partes de la data que llega
    // return $request->horaInicio;
  
    }


    //FUNCION PARA REALIZAR LA ACTUALIZACION DE UN REGISTRO
    public function editarTarea(Request $request){ 
       //Se busca el registro a buscar
       $Tarea=Tarea::find($request->id);
       //Ahora se empieza a actualiar dato por dato similar al insertar
       $Tarea->tituloTarea=$request->tituloTarea; //campos del json
       $Tarea->prioridad=$request->prioridad;
       $Tarea->descripcion=$request->descripcion;
       $Tarea->estado=$request->estado;
       $Tarea->fechaInicio=$request->fechaInicio;
       $Tarea->fechaFin=$request->fechaFin;
       $Tarea->horaInicio=$request->horaInicio;
       $Tarea->horaFin=$request->horaFin;
       $Tarea->users_id=$request->users_id;
       //Este realiza la actualizacion en la bd.
       try {
        $Tarea->save();
        return response()->json("registro modificado con éxito");
    }catch (\Throwable $th) {
        return response()->json("Error en la modificación del registro".$th);
    }  
       }//fin del metodo editarTarea



       public function eliminarTarea(Request $request) {  
        //Se recibe como parametro el $id y se busca, este se almacena en la variable Tarea
        $Tarea=Tarea::find($request->id);
        //Se realiza la eliminacion del registro.
        try{
            $Tarea->delete();
            return response()->json("Registro Eliminado con exito");
        }catch (\Throwable $th) {
            return response()->json("Error al eliminar el registro");
        }  
        

       } 
}
<?php

namespace App\Http\Controllers\TareasCDSAH;

use Illuminate\Http\Request;
use App\Model\TareasCDSAH\Reporte;
use  App\Http\Controllers\Controller;
use App\User;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Inicializar el middleware
    //  public function __construct()
    //  {
    //      $this->middleware('jwt');
    
    //  }

    public function index(request $request){
        $reportes = Reporte::where('users_id', $request->users_id )->where('fecha', $request->fecha )->get(); 
        return response()->json(["reporte"=>$reportes]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create(){
    
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    //Esta variable es la que se enviara en el responso con la respuesta a cada caso posible
     $mensaje="";    
     //Creamos una instancia del modelo de reporte
     $Reporte = new Reporte;
     if (  $request->descripcion && $request->fecha &&  $request->users_id !=NULL ) {
      // Esto accede a la propiedades de la tarea y lo inserta lo que viene en la data que es un arreglo asociativo  entonces se accede a la propiedad que se quiere
        $Reporte->descripcion=$request->descripcion;
        //El campo observación se envia vacio porque al insertar un reporte el alumno no puede generar una observacion. solo el docente
        //cuando modifica un reporte puede llenar el campo de observación.
        $Reporte->observacion=" ";
        $Reporte->fecha=$request->fecha;
        $Reporte->users_id=$request->users_id;

        try {
            $Reporte->save();
            $mensaje="Reporte insertado con éxito";
            
        }catch (\Throwable $th) {
            $mensaje="Error en la inserción del reporte";
        }
     } else {
         $mensaje="Revise los datos que esta enviando para la insercion del reporte";
     }
     

     return response()->json($mensaje);
    
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
     * Metodo para actualizar el campo observacion de un reporte
     *La idea es que este metodo sea accesible desde la vista maestro
     *para que el maestro pueda dejar una observacion a cada reporte.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit(){
    
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $mensaje="";

        //Se busca el reporte a editar
        if ($request->id && $request->observacion!=NULL and is_numeric($request->id)) {
            
            $Reporte=Reporte::find($request->id);
            $Reporte->observacion=$request->observacion;

            try {
                $Reporte->save();
                $mensaje="Observación agregada con éxito";
            }catch (\Throwable $th) {
                $mensaje="Ocurrió un error interno al insertar la observación";
            }
            
        } else {
            $mensaje="No ha enviado los campos necesarios para actualizar el reporte";
        }

        return response()->json($mensaje);
    }// final del metodo update 

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


    public function buscarReportePorId(Request $request){
        $Reporte = Reporte::where('id', $request->id )->get(); 
        return response()->json(["reporte"=>$Reporte]);
    }

   
}

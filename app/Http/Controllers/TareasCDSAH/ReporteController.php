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

    /*
    Función para listar todos los reportes 
    */
    public function index(request $request){
        $reportes = Reporte::where('users_id', $request->users_id )->where('fecha', $request->fecha )->get(); 
        return response()->json(["reporte"=>$reportes]); 
    }

    
   //Método para insertar un nuevo reporte
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

    

   //Función para poder insertar una observación al reporte que genera un alumno, este metodo solo es accesible desde la vista docente
    public function update(Request $request){
        $mensaje="";

       //Se verifica que el parametros necesarios para agregar la observación no sean null
        if ($request->id && $request->observacion!=NULL and is_numeric($request->id)) {
            
             //Se busca el reporte a editar
            $Reporte=Reporte::find($request->id);
            $Reporte->observacion=$request->observacion;

            //Se procede a realizar la modificacion
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


    //Método para buscar una función por el id
    public function buscarReportePorId(Request $request){
        $Reporte = Reporte::where('id', $request->id )->get(); 
        return response()->json(["reporte"=>$Reporte]);
    }

   
}

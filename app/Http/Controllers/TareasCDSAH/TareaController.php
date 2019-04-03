<?php

namespace App\Http\Controllers\TareasCDSAH;

use Illuminate\Http\Request;

use App\Model\TareasCDSAH\Tarea;
use  App\Http\Controllers\Controller;
use App\User;
use App\Model\TareasCDSAH\Reporte;
class TareaController extends Controller
{
    

    /*Este metodo es para retornar todas las tareas que pertenecen a la fecha que se recibe como parametro
    y retorna un json que contiene un arreglo asociativo donde van todas las tareas encontradas pertenecientes
    a la fecha definida, y el estado de la tarea se verifica a nivel de frontend.
    */
    public function tareasDiarias(Request $request){
        //Obtenenos todas las tareas y todos los reportes de un usuario en la fecha que se requiere
        $tareas = Tarea::where('users_id', $request->users_id )->where('fechaFin', $request->fechaFin )->get();
        $reportes = Reporte::where('users_id', $request->users_id )->where('fecha', $request->fechaFin )->get();
        
        //retornamos un arreglo que contiene las tareas y los reportes
         return response()->json(["tarea"=>$tareas,"reporte"=>$reportes]);
    }

    /*Metodo para insertar una nueva tarea que se inserta desde un formulario
    */

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
    $Tarea->users_id=$request->users_id;

    try {
        $Tarea->save();
        return response()->json("Tarea insertada con éxito");
    }catch (\Throwable $th) {
        return response()->json("Error al insertar la tarea");
    }
    }


    //Funcion para editar una tarea, edita todos los campos y solo es accesible desde la vista administrador
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
       $Tarea->users_id=$request->users_id;
       //Este realiza la actualizacion en la bd.
       try {
        $Tarea->save();
        return response()->json($Tarea->tituloTarea);
        }catch (\Throwable $th) {
        return response()->json("Error en la modificación del registro".$th);
        }  
    }//fin del metodo editarTarea


    //Este metodo es para buscar una tarea por id que se utiliza cuando se requiere modificar una tarea
    //para cargar los datos de la tarea en un formulario donde se modifican los datos de la tarea.
    public function buscarTareaPorId(Request $request){
        $tarea = Tarea::where('id', $request->id )->get(); 
        return response()->json(["tarea"=>$tarea]);
    }



    //Este metodo elimina una tarera por el id, se va colocar en un boton que invoque el metodo para eliminar la tarea.
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
    } //fin del metodo eliminarTarea



   //Este metodo cambia el estado de pendiente a finalizada de las tareas, se ejecuta para cambiar el estado de la tarea
   //por parte del usuario en la vista princiapl   Estado Pendiente---> Estado Terminada

    public function editarEstadoTarea(Request $request){ 
        //Se busca el registro a cambiar el estado
        $Tarea=Tarea::find($request->id);
        //Ahora se actualiza el estado 
        $Tarea->estado=$request->estado;
  
        //Este realiza la actualizacion en la bd.
        try {
         $Tarea->save();
         return response()->json($Tarea->tituloTarea);
         }catch (\Throwable $th) {
         return response()->json("Error en la modificación del registro".$th);
         }  
    }//fin del metodo editarTarea



    /*Esta funcion pretende actualizar todas las tareas que presenten un estado de pendiente y se pasan a estado 
    no cumplida al momento de darle click al boton de generar reporte, de esta manera se verifica que no quede ninguna 
    tarea de dias anteriores con estado pendiente*/
    public function editarEstadoTareaMultiple(Request $request){ 
           
            try {
                 //Se buscan todas las tareas con etado pendiente
             $tareas = Tarea::where('users_id', $request->users_id )->where('fechaFin', $request->fechaFin )->where('estado', 'Pendiente' )->get(); 
             
             //Ahora se empieza a actualiar dato por dato similar al insertar   
                 foreach ($tareas as $key) {
                     
                    //Se cambia el estado de cada tarea de pendiente a incumplida
                     $key->estado="Incumplida";
                     $key->update();
                 }
                 return response()->json("Las tareas que tenia pendientes se pasaron a Incumplidas");
                
            }catch (\Throwable $th) {
                return response()->json("Hubo un error al procesar la modificacion de los estados de las tareas incumplidas".$th);
            } 
            
            
    }

    /*Esta funcion pretende actualizar todas las tareas que presenten un estado de pendiente y se pasan a estado 
    no cumplida al momento de recargar la pagina , de esta manera se verifica que no quede ninguna tarea de dias
     anteriores con estado pendiente*/
    public function editarEstadoTareaDiasAtras(Request $request){ 
           
            try {
                     //Se busca el registro a buscar
                 $tareas = Tarea::where('users_id', $request->users_id )->where('fechaFin','<', $request->fechaFin )->where('estado', 'Pendiente' )->get(); 
                 
                 //Ahora se empieza a actualiar dato por dato similar al insertar   
                     foreach ($tareas as $key) {
                         
                         $key->estado="Incumplida";
                         $key->update();
                     }
                     return response()->json("Todas las tareas de dias anteriores al actual con estado pendiente se movió a estado incumplidas  ");
                    
            }catch (\Throwable $th) {
                    return response()->json("Hubo un error al procesar la modificacion de los estados de las tareas incumplidas".$th);
            } 
                
                
     }
    
 
}//Fin de la clase
<?php

namespace App\Http\Controllers\TareasCDSAH;

use Illuminate\Http\Request;

use App\Model\TareasCDSAH\Tarea;
use  App\Http\Controllers\Controller;
use App\User;
use App\Model\TareasCDSAH\Reporte;
class TareaController extends Controller
{
    
    public function index()
    {   
        $datos=User::all();
        return  response()->json(['datos'=>$datos]);
    }



    /*Este metodo es para retornar todas las tareas que pertenecen a la fecha que se recibe como parametro
    y retorna un json que contiene un arreglo asociativo donde van todas las tareas encontradas pertenecientes
    a la fecha definida, y el estado de la tarea se verifica a nivel de frontend.
    */
    public function tareasDiarias(Request $request){
        //Obtenenos todas las tareas y todos los reportes de un usuario en la fecha que se requiere
        if ($request->users_id!=null && $request->fecha!=null ){
            try {
                $tareas = Tarea::where('users_id', $request->users_id )->where('fecha', $request->fecha )->get();
                $reportes = Reporte::where('users_id', $request->users_id )->where('fecha', $request->fecha )->get();
                return response()->json(["tarea"=>$tareas,"reporte"=>$reportes]);

        }catch (\Throwable $th) {
            return response()->json("Error al obtener los datos");
        }
            
        } else {
            return response()->json("No ha enviado los parametros necesarios para realizar la consulta");
        }    
    }

    /*Metodo para insertar una nueva tarea que se inserta desde un formulario
    */
    public function insertarTarea(request $request){

    //Esta variable es la que se enviara en el responso con la respuesta a cada caso posible
    $mensaje="";    
    //Creamos una instancia del modelo
    $Tarea = new Tarea;
    //Obtenemos la fecha actual del servidor para comparar con la fecha que queremos insertar la tarea
    $fechaActual = date("Y-m-d");

    //Validamos que los campos a insertar no sean nulos
    if ($request->tituloTarea && $request->prioridad && $request->descripcion && $request->fecha && $request->users_id!=NULL  ) {
    
      //Validamos que la fecha de la tarea a insertar sea mayor o igual a la fecha actual.
        if ($request->fecha>=$fechaActual) {

           //Esto accede a la propiedades de la tarea y lo inserta lo que viene en la data que es un arreglo asociativo  entonces se accede a la propiedad que se quiere        
            $Tarea->tituloTarea=$request->tituloTarea; //campos del json
            $Tarea->prioridad=$request->prioridad;
            $Tarea->descripcion=$request->descripcion;
            //Por defecto las nuevas tareas se insertan con estado pendiente
            $Tarea->estado='Pendiente';
            $Tarea->fecha=$request->fecha;
            $Tarea->users_id=$request->users_id;

            //Procedemos a intentar realizar la insercion de la bd
            try {
                $Tarea->save();
                $mensaje="Tarea insertada con éxito";

            }catch (\Throwable $th) {
                $mensaje="Ocurrio un error interno al insertar la tarea";
            }
            
        } else {  
             $mensaje="La fecha para insertar una tarea debe ser mayor o igual al dia actual";
        }
        
    } else {
        $mensaje="Error en la inserción, no se puede contener campos nulos";
    }
     return response()->json($mensaje);  
    }



    //Funcion para editar una tarea, edita todos los campos y solo es accesible desde la vista administrador
    public function editarTarea(Request $request){

         $mensaje="";
        //Verificamos que el parametro id no sea nullo y que sea numerico para proceder a buscar el elemento en la bd
        if ($request->id!=NULL && is_numeric($request->id)) {
            
            //En la variable tarea se almacena el objeto a modificar
            $Tarea=Tarea::find($request->id);
            
            //Capturamos la fecha actual para compararla con la nueva que se quiere modificar
            $fechaActual = date("Y-m-d");

            if ($request->fecha!=NULL && $request->fecha>=$fechaActual) {

                if ($request->tituloTarea && $request->prioridad && $request->descripcion  && $request->users_id!=NULL ) {
                    //Ahora se empieza a actualizar dato por dato similar al insertar
                       $Tarea->tituloTarea=$request->tituloTarea; 
                       $Tarea->prioridad=$request->prioridad;
                       $Tarea->descripcion=$request->descripcion;
                       $Tarea->estado=$request->estado;
                       $Tarea->fecha=$request->fecha;
                       $Tarea->users_id=$request->users_id;
       
                       try {
                           $Tarea->save();
                           $mensaje="Tarea modificada con éxito";
                           }catch (\Throwable $th) {
                           $mensaje="Ocurrió un error interno al modificar la tarea";
                           }  
       
                   } else {
                         $mensaje="Error en la inserción, no se puede contener campos nulos al modificar la tarea";         
                   }
                
            } else {

                $mensaje="La fecha para modificar una tarea debe ser mayor o igual al dia actual";
            }
        
        } else {
           $mensaje="Error, no ha enviado el id de la tarea a editar o el parametro enviado no es numerico";
        }
        return response()->json($mensaje);
        
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
            return response()->json("Tarea eliminada con éxito");
        }catch (\Throwable $th) {
            return response()->json("Error al eliminar la tarea");
        }  
    } //fin del metodo eliminarTarea



   //Este metodo cambia el estado de pendiente a finalizada de las tareas, se ejecuta para cambiar el estado de la tarea
   //por parte del usuario en la vista princiapal   Estado Pendiente---> Estado Terminada

    public function editarEstadoTarea(Request $request){ 
        //Se busca el registro a cambiar el estado
        $Tarea=Tarea::find($request->id);
        //Ahora se actualiza el estado 
        $Tarea->estado=$request->estado;
  
        //Este realiza la actualizacion en la bd.
        try {
         $Tarea->save();
         return response()->json();
         }catch (\Throwable $th) {
         return response()->json("Error en la modificación del registro");
         }  
    }//fin del metodo editarTarea



    /*Esta funcion pretende actualizar todas las tareas que presenten un estado de pendiente y se pasan a estado 
    no cumplida al momento de darle click al boton de generar reporte, de esta manera se verifica que no quede ninguna 
    tarea de dias anteriores con estado pendiente*/
    public function editarEstadoTareaMultiple(Request $request){ 
           
            try {
                 //Se buscan todas las tareas con etado pendiente
             $tareas = Tarea::where('users_id', $request->users_id )->where('fecha', $request->fecha )->where('estado', 'Pendiente' )->get(); 
             
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
                     //Luis: modifiqué de el campo de fechaFin a fecha abril4,2019
                 $tareas = Tarea::where('users_id', $request->users_id )->where('fecha','<', $request->fecha )->where('estado', 'Pendiente' )->get(); 
                 
                 //Ahora se empieza a actualiar dato por dato similar al insertar   
                     foreach ($tareas as $key) {
                         
                         $key->estado="Incumplida";
                         $key->update();
                     }
                     return response()->json("Todas las tareas de dias anteriores al actual con estado pendiente se movió a estado incumplidas");
                    
            }catch (\Throwable $th) {
                    return response()->json("Hubo un error al procesar la modificacion de los estados de las tareas incumplidas");
            } 
                
                
     }  
    
 
}//Fin de la clase
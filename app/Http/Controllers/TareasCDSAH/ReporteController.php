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

    public function index(){
    //Retornamos todos los reportes
    return response()->json(["Reporte"=>Reporte::all()]);
        
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
     //Creamos una instancia del modelo de reporte
     $Reporte = new Reporte;
     //Esto accede a la propiedades de la tarea y lo inserta lo que viene en la data que es un arreglo asociativo  entonces se accede a la propiedad que se quiere
     $Reporte->descripcion=$request->descripcion;
     $Reporte->observacion=$request->observacion;
     $Reporte->fecha=$request->fecha;
     $Reporte->users_id=$request->users_id;
 
     try {
         $Reporte->save();
         return response()->json("registro insertado bien hecho don human");
     }catch (\Throwable $th) {
         return response()->json("Registro no insertado la regaste don human");
     }
    
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
    public function edit(Request $request)
    {
        //Se busca el registro a buscar
        $Reporte=Reporte::find($request->id);
        //Ahora se empieza a actualiar dato por dato similar al insertar
        //campos del json
        $Reporte->descripcion=$request->descripcion;
        $Reporte->observacion=$request->observacion;
        $Reporte->fecha=$request->fecha;
        $Reporte->users_id=$request->users_id;

        //Este realiza la actualizacion en la bd.
        try {
         $Reporte->save();
         return response()->json("Observación Agregada con Exito");
     }catch (\Throwable $th) {
         return response()->json("Operación no completada");
     }
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


    public function buscarReportePorId(Request $request){
        $Reporte = Reporte::where('users_id', $request->id )->get(); 
        return response()->json(["reporte"=>$reporte]);
    }


    
}

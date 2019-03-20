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
        //
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
    public function dailyTask()
    {
        $tareas = Tarea::where('users_id', 1 )->where('fechaFin', date("y")."-".date("m")."-".date("d"))->get(); 
        return response()->json(["tarea"=>$tareas]);
        //devuelve la o las tareas que coincidan con la fecha actual

    }
}

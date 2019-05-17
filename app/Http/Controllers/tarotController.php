<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarot;
use Illuminate\Database\Eloquent\SoftDeletes;


class tarotController extends Controller
{
    use SoftDeletes;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getAll()
    {
        $tarot = Tarot::get();
        return response()->json($tarot);
    }
    
    /**
     * show the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $tarot = Tarot::where('id', $id)->get();
        return response()->json($tarot);
    }
    /** 
     * Store a newly created resource in storage.
     *  
     * @param \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\Response 
     * 
    */
    public function create(Request $request)
    {
        $tarot = new Tarot;
        $tarot->usuario_id = $request->usuario_id;

        if(isset($request->pregunta)){
            $tarot->pregunta = $request->pregunta;
        }
        if(isset($request->respuesta)){
            $tarot->respuesta = $request->respuesta;
        }
        if(isset($request->estado)){
            $tarot->estado = $request->estado;
        }
        if(isset($request->fechaPedido)){
            $tarot->fechaPedido = $request->fecha_pedido;
        }
        if(isset($request->fechaCita)){
            $tarot->fechaCita = $request->fecha_cita;
        }
        if(isset($request->tiposTirada)){
            $tarot->tiposTirada = $request->tipos_tirada;
        }
        if(isset($request->presencial)){
            $tarot->presencial = $request->presencial;
        }
        
        $tarot->save();
        return response()->json($tarot);
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
        $tarot = Tarot::findOrFail($id);
        if(isset($request->pregunta)){
            $tarot->pregunta = $request->pregunta;
        }
        if(isset($request->respuesta)){
            $tarot->respuesta = $request->respuesta;
        }
        if(isset($request->estado)){
            $tarot->estado = $request->estado;
        }
        if(isset($request->fechaPedido)){
            $tarot->fechaPedido = $request->fecha_pedido;
        }
        if(isset($request->fechaCita)){
            $tarot->fechaCita = $request->fecha_cita;
        }
        if(isset($request->tiposTirada)){
            $tarot->tiposTirada = $request->tipos_tirada;
        }
        if(isset($request->presencial)){
            $tarot->presencial = $request->presencial;
        }
        $tarot->save();

        return response()->json($tarot);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $tarot = Tarot::findOrFail($id);
        $tarot->delete();
        return response()->json([
            'el id ' . $id .  ' ha sido borrado exitosamente.'
            ]);
    }
}

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
     * @param \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\Response
     */
     public function getAll(Request $request)
    {
        $userId = $request->header('user_id');
        $tarot = Tarot::where('userId', $userId)->get();
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
        try {
            $tarot = new Tarot;
            $tarot->userId = $request->header('user_id');
            $tarot->question = $request->question;
            $tarot->status = 'pending';
            $tarot->orderDate = date('Y-m-d H:i:s');
            $tarot->pullType = $request->pullType;
            $tarot->presence = $request->presence;
            if($tarot->presence == true){
                $tarot->appointmentDate = $request->appointmentDate;
            }
            $tarot->save();
            return response()->json($tarot);
        } catch (\Throwable $th) {
            return response()->json([$th, 400]);
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
        try{
            
            $tarot = Tarot::findOrFail($id);
            if($tarot->status != 'pending' || $tarot->userId != $request->header('user_id')){
                return response()->json([]);             
            }
    
            if(isset($request->question)){
                $tarot->question = $request->question;
            }
            if(isset($request->appointmentDate)){
                $tarot->appointmentDate = $request->appointmentDate;
            }
            if(isset($request->pullType)){
                $tarot->pullType = $request->pullType;
            }
            if(isset($request->presence)){
                $tarot->presencial = $request->presence;
            }
            $tarot->save();
    
            return response()->json($tarot);
        } catch (\Throwable $th) {
            return response()->json([[], 404]);
        }
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
        if($tarot->status != 'pending'){
            return response()->json([]);             
        }
        $tarot->delete();
        return response()->json([
            'id ' . $id .  ' has been successfully deleted.'
            ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $tarot = Tarot::findOrFail($id);
        try {
            $tarot->status = $request->status;
            $tarot->save();
            return response()->json($tarot);
        } catch (\Throwable $th) {
            return response()->json([$th, 400]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateResponse(Request $request, $id)
    {
        $tarot = Tarot::findOrFail($id);
        try {
            $tarot->answer = $request->response;
            $tarot->save();
            return response()->json($tarot);
        } catch (\Throwable $th) {
            return response()->json([$th, 400]);
        }
    }

}
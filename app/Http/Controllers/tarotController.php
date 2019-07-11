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
     public function getAll($userId)
    {
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
            $tarot->userId = $request->userId;
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
        $tarot = Tarot::findOrFail($id);
        if(isset($request->question)){
            $tarot->question = $request->question;
        }
        if(isset($request->answer)){
            $tarot->answer = $request->answer;
        }
        if(isset($request->status)){
            $tarot->status = $request->status;
        }
        if(isset($request->orderDate)){
            $tarot->orderDate = $request->orderDate;
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
            'id ' . $id .  ' has been successfully deleted.'
            ]);
    }
}
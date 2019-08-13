<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Akashic;

class akashicController extends Controller
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
        $akashic = Akashic::where('userId', $userId)->get();
        return response()->json($akashic);
    }
    /**
     * show the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $akashic = Akashic::where('id', $id)->get();
        return response()->json($akashic);
    }
    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $akashic = new Akashic;
            $akashic->userId = $request->header('user_id');
            $akashic->devolution = '';
            $akashic->permission = $request->permission;
            $akashic->status = 'pending';
            $akashic->orderDate = date('Y-m-d H:i:s');
            $akashic->subjects = $request->subjects;
            $akashic->save();
            return response()->json($akashic);
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
        try {

            $akashic = Akashic::findOrFail($id);
            if($akashic->status != 'pending' || $akashic->userId != $request->header('user_id')){
                return response()->json([]);             
            }
    
            if(isset($request->permission)){
                $akashic->permission = $request->permission;
            }
            $akashic->save();
    
            return response()->json($akashic);
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
    public function delete(Request $request, $id)
    {
        $akashic = Akashic::findOrFail($id);
        if($akashic->status != 'pending' || $akashic->userId != $request->header('user_id')){
            return response()->json([]);             
        }
        $akashic->delete();
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
        $akashic = Akashic::findOrFail($id);
        try {
            $akashic->status = $request->status;
            $akashic->save();
            return response()->json($akashic);
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
        $akashic = Akashic::findOrFail($id);
        try {
            $akashic->devolution = $request->response;
            $akashic->save();
            return response()->json($akashic);
        } catch (\Throwable $th) {
            return response()->json([$th, 400]);
        }
    }
    public function getListForProductStatus(Request $request) 
    {
        $status = ($request->status != NULL) ? $request->status : 'pending';
        $akashic = Akashic::where('status', $status)->get();
        return response()->json($akashic);
    }
}

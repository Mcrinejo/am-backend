<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Reiki;

class reikiController extends Controller
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
        $userId = $request->header('access_token');
        $reiki = Reiki::where('userId', $userId)->get();
        return response()->json($reiki);
    }

    /**
     * show the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $reiki = Reiki::where('id', $id)->get();
        return response()->json($reiki);
    }
    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request $request 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $reiki = new Reiki;
            $reiki->userId = $request->userId;
            $reiki->devolution = '';
            $reiki->permission = $request->permission;
            $reiki->status = 'pending';
            $reiki->orderDate = date('Y-m-d H:i:s');
            $reiki->save();
            return response()->json($reiki);
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

            $reiki = Reiki::findOrFail($id);
            if($reiki->status != 'pending'){
                return response()->json([]);             
            }
    
            if(isset($request->permission)){
                $reiki->permission = $request->permission;
            }
            $reiki->save();
    
            return response()->json($reiki);
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
        $reiki = Reiki::findOrFail($id);
        if($reiki->status != 'pending'){
            return response()->json([]);             
        }
        $reiki->delete();
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
        $reiki = reiki::findOrFail($id);
        try {
            $reiki->status = $request->status;
            $reiki->save();
            return response()->json($reiki);
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
        $reiki = Reiki::findOrFail($id);
        try {
            $reiki->devolution = $request->response;
            $reiki->save();
            return response()->json($reiki);
        } catch (\Throwable $th) {
            return response()->json([$th, 400]);
        }
    }
}

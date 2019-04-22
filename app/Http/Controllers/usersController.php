<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;



class usersController extends Controller
{
    use SoftDeletes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $user = User::get();
        return response()->json($user);
    }

    /**
     * show the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $user = User::where('id', $id)->get();
        return response()->json($user);
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
        $user = new User;
        $role_user = Role::where('name','user')->first();
        $user->mail = $request->mail;
        $user->password = Hash::make($request->password);
        $user->confirmation_code = (string) Str::uuid();
        
        if(isset($request->address)){
            $user->address = $request->address;
        }
        if(isset($request->name)){
            $user->name = $request->name;
        }
        if(isset($request->country)){
            $user->country = $request->country;
        }
        if(isset($request->city)){
            $user->city = $request->city;
        }
        if(isset($request->zipcode)){
            $user->zipcode = $request->zipcode;
        }
        if(isset($request->birthdate)){
            $user->birthdate = $request->birthdate;
        }
        $user->save();
        $user->roles()->attach($role_user);

        
        return response()->json($user);
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
        $user = User::findOrFail($id);
        if(isset($request->address)){
            $user->address = $request->address;
        }
        if(isset($request->name)){
            $user->name = $request->name;
        }
        if(isset($request->country)){
            $user->country = $vcountry;
        }
        if(isset($request->city)){
            $user->city = $request->city;
        }
        if(isset($request->zipcode)){
            $user->zipcode = $request->zipcode;
        }
        if(isset($request->birthdate)){
            $user->birthdate = $request->birthdate;
        }
        $user->save();

        return response()->json($user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'el id ' . $id .  ' ha sido borrado exitosamente.'
            ]);
    }
    public function verified($confirmation_code){
        $user = User::where('confirmation_code', $confirmation_code)->first();
        if (!$user) {
            return response()->json([], 404);
        }
        $user->confirmed = 1;
        $user->save();
        return response()->json($user);
    }
}

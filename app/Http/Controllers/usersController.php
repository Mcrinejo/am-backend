<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;
use function GuzzleHttp\json_encode;

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
        try {
            $password = md5($request->password);
            $oauth_host = config('services.oauth_server.host');
            $oauth_path = '/app/registry';
            $client = new Client(['base_uri' => $oauth_host]);
            $data = json_encode([
                'email' => $request->email,
                'password' => $password,
                'roles' => ['user']
            ]);
            $response = $client->post($oauth_path, [
                // un array con la data de los headers como tipo de peticion, etc.
                'headers' => [
                    'x-key' => '2fvTdG53VCp6z8ZbV66h',
                    'content-type' => 'application/json'
                ],
                // array de datos del formulario
                'body' => $data
            ]);
            $res = json_decode($response->getBody(), true);
            } catch (\Throwable $th) {
                return response()->json([$th->getMessage(), 400]);
            }
        $user = new User;
        $user->email = $request->email;
        $user->external_id = $res['user_id'];
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


    public function is_valid_email($email){
      $matches = null;
      return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $email, $matches));
    }

    public function login(Request $request){
        try {
            $password = md5($request->password);
            $oauth_host = config('services.oauth_server.host');
            $oauth_path = '/app/login';
            $client = new Client(['base_uri' => $oauth_host]);
            $data = json_encode([
                'email' => $request->email,
                'password' => $password
            ]);
            $response = $client->post($oauth_path, [
                // un array con la data de los headers como tipo de peticion, etc.
                'headers' => [
                    'x-key' => '2fvTdG53VCp6z8ZbV66h',
                    'content-type' => 'application/json'
                ],
                // array de datos del formulario
                'body' => $data
            ]);
            $res = json_decode($response->getBody(), true);
            } catch (\Throwable $th) {
                return response()->json([$th->getMessage(), 400]);
            }
            $user = array(
                'user' => User::where('email', $request->email)->first(),
                'access_token' => $res['access_token']
            );
            return response()->json($user);
    }
}
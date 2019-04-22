<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class defaultController extends Controller
{
    /**
     * Health check
     *
     * @return application/json
     */

    public function get()
    {
        return response()->json([
        'status' => 'ok'
        ]);
    }
    /**
     * Create new user in storage
     *
     * 
     * @return application/json
     */
    public function create()
    {
      
    }


    /**
     * Update an existing user in storage
     * 
     * 
     * @return application/json
     */
    public function update($id)
    {

    }
    

    /**
     * Delete an existing user in storage
     * 
     *
     * @return application/json
     */
    public function delete($id)
    {

    }
}

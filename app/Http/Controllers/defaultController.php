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
    /**
     * @OA\Get(
     *     path="/api/healthCheck",
     *     summary="Finds Pets by tags",
     *     tags={"pet"},
     *     description="Muliple tags can be provided with comma separated strings. Use tag1, tag2, tag3 for testing.",
     *     operationId="findPetsByTags",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Pet")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid tag value",
     *     ),
     *     security={
     *         {"petstore_auth": {"write:pets", "read:pets"}}
     *     },
     *     deprecated=true
     * )
     */
    public function show()
    {
        return response()->json([
            'status' => 'ok'
        ]);
    }
}

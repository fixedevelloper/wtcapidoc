<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class Controller
{

    /**
 * success response method.
 *

     * @return JsonResponse
 */

    public function sendResponse($result, $message)

    {

        $response = [

            'success' => true,
            'data'    => $result,
            'message' => $message,

        ];


        return response()->json($response, 200);

    }


    /**
     * return error response.
     *

     * @return JsonResponse
     */

    public function sendError($error, $errorMessages = [], $code = 404)

    {

        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){

            $response['data'] = $errorMessages;

        }


        return response()->json($response, $code);

    }
}

<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function sendJsonResponse($data, $responseCode = 200){
        return response()->json($data, $responseCode);
    }

    protected function sendEmptyResponse($responseCode = 200){
        return response('', $responseCode);
    }


}

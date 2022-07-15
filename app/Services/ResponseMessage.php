<?php
namespace App\services;

use Illuminate\Http\Response;

class ResponseMessage {
    public static function successResponse():Response
    {
        return response('valid operator', 200);
    }

    public static function failedResponse():response
    {
        return response('failed operator', 400);
    }
}
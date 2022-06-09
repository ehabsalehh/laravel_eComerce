<?php
namespace App\services;

use Illuminate\Http\Response;

class ResponseMessage {
    public static function succesfulResponse():Response
    {
        return response('valid operator', 200);
    }

    public static function failedResponse():response
    {
        return response('failled operator', 400);
    }
}
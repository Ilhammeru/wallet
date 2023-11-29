<?php

use Illuminate\Contracts\Validation\Validator;
use Vinkla\Hashids\Facades\Hashids;

if (!function_exists('getLocalErrorMessage')) {
    function getLocalErrorMessage($message) {
        $out = $message;
        if (env("APP_ENV") == 'local' && gettype($message) != 'string') {
            $out = 'Error at line ' . $message->getLine() . '. File: ' . $message->getFile() . '. Message: ' . $message->getMessage();
        }

        return $out;
    }
}

if (!function_exists('buildErrorResponse')) {
    function buildErrorResponse($message) {
        return [
            'success' => false,
            'message' => getLocalErrorMessage($message)
        ];
    }
}

if (!function_exists('encodeID')) {
    function encodeID($id)
    {
        return Hashids::encode($id);
    }
}

if (!function_exists('decodeID')) {
    function decodeID($string)
    {
        $decode = Hashids::decode($string);
        if (($decode) && (count($decode) > 0)) {
            return $decode[0];
        }
    }
}

if (!function_exists('formRequestResponseHelper')) {
    function formRequestResponseHelper(Validator $validator) {
        return response()->json([
            'success'       => false,
            'message'       => $validator->errors()->first(),
            'data'          => $validator->errors(),
        ], 400);
    }
}

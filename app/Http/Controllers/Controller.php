<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($data)
    {
        return response()->json([
            'data' => isset($data['data']) ? $data['data'] : [],
            'message' => $data['message'],
            'success' => $data['success'],
        ], $data['success'] ? 201 : 500);
    }

    public function success($data)
    {
        return response()->json([
            'data' => $data['data'],
            'message' => $data['message'],
            'success' => true,
        ], 200);
    }

    public function failed($data)
    {
        return response()->json([
            'data' => $data['data'] ?? [],
            'message' => $data['message'],
            'success' => false,
        ], 500);
    }

    public function getLocalErrorMessage($message)
    {
        $out = $message;
        if (env("APP_ENV") == 'local') {
            $out = 'Error at line ' . $message->getLine() . '. File: ' . $message->getFile() . '. Message: ' . $message->getMessage();
        }

        return $out;
    }
}

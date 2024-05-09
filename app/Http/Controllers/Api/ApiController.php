<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sendSuccess($data, $message = '', $statusCode = 200)
    {
        return [
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data
        ];
    }

    public function sendError($message, $statusCode, $data = [])
    {
        return [
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data
        ];
    }
}

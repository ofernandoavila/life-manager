<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public static function response($data = [], $statusCode = 200, string $message = null) {
        return response(content: [
            'message' => $message,
            'data' => $data
        ], status: $statusCode);
    }
}

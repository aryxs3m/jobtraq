<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    protected function success($data): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}

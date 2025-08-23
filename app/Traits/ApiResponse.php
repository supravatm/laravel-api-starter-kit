<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success($data = [], $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function error($error = [], $message = 'Error', $code = 400): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'errors' => $error,
        ], $code);
    }

    protected function validationErrorResponse($errors, $message = 'Validation Error', $code = 422): JsonResponse
    {
        return $this->error($message, $code, $errors);
    }
}

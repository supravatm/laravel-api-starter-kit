<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    protected function success($data = [], $message = 'Success', $code = Response::HTTP_OK): JsonResponse
    {
        $repsonse = [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
        return response()->json($repsonse, $code);
    }

    protected function error($message = 'Error', int $code = Response::HTTP_INTERNAL_SERVER_ERROR, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
            ], $code);
    }

    protected function validationErrorResponse($errors, $message = 'Validation Error', $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return $this->errorResponse($message, $code, $errors);
    }
}

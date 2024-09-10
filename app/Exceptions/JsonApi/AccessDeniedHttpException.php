<?php

namespace App\Exceptions\JsonApi;

use Exception;

class AccessDeniedHttpException extends Exception
{
    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => [
                [
                    'title' => __('Forbidden'),
                    'detail' => $this->getMessage(),
                    'status' => "{$this->code}",
                ],
            ],
        ], $this->code);
    }
}

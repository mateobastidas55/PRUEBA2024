<?php

namespace App\Exceptions\JsonApi;

use Exception;

class UnauthorizedHttpException extends Exception
{
    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => [
                [
                    'title' => __('Unauthorized'),
                    'detail' => $this->getMessage(),
                    'status' => "{$this->code}",
                ],
            ],
        ], $this->code);
    }
}

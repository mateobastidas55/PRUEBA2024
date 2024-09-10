<?php

namespace App\Exceptions\JsonApi;

use Exception;

class MethodNotAllowedHttpException extends Exception
{
    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'errors' => [
                [
                    'title' => __('The method is not supported'),
                    'detail' => $this->getMessage(),
                    'status' => "{$this->code}",
                ],
            ],
        ], $this->code);
    }
}

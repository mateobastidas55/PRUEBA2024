<?php

namespace App\Exceptions\JsonApi;

use Exception;

class NotFoundHttpException extends Exception
{
    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'errors' => [
                [
                    'title' => __('The specified URL cannot be found'),
                    'detail' => $this->getMessage(),
                    'status' => "{$this->code}",
                ],
            ],
        ], $this->code);
    }
}

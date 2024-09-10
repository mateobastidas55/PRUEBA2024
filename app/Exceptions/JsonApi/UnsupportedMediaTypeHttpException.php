<?php

namespace App\Exceptions\JsonApi;

use Illuminate\Support\Str;

use Exception;
use Illuminate\Http\Request;

class UnsupportedMediaTypeHttpException extends Exception
{
    public function render(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'errors' => [
                [
                    'title' => __('Unsupported Media Type'),
                    'detail' => Str::of($this->getMessage())->length() > 0 ? $this->getMessage() : 'The request must be a made with a JSON API header, Check your request and try again.',
                    'status' => "{$this->code}",
                ],
            ],
        ], $this->code);
    }
}

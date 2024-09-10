<?php

namespace App\Exceptions\JsonApi;

use Illuminate\Support\Str;

use Exception;
use Illuminate\Http\Request;

class BadRequestHttpException extends Exception
{
    public function render(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'errors' => [
                [
                    'title' => __('Bad Request'),
                    'detail' => Str::of($this->getMessage())->length() > 0 ? $this->getMessage() : 'Bad request, please check your request and try again.',
                    'status' => "{$this->code}",
                ],
            ],
        ], $this->code);
    }
}

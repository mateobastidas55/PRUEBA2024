<?php

namespace App\OpenApi\Responses\user;

use App\OpenApi\Schemas\user\ResponseLogoutSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ResponseLogoutResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
            ->content(
                MediaType::json()->schema(ResponseLogoutSchema::ref())
            );
    }
}

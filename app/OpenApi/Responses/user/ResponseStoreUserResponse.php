<?php

namespace App\OpenApi\Responses\user;

use App\OpenApi\Schemas\user\ResponseStoreUserSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ResponseStoreUserResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::create()->description('Successful response')
            ->content(
                MediaType::json()->schema(ResponseStoreUserSchema::ref())
            );
    }
}

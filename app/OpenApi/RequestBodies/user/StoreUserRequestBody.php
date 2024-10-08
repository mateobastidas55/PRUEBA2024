<?php

namespace App\OpenApi\RequestBodies\user;

use App\OpenApi\Schemas\user\StoreUserRequestSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreUserRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('StoreUserRequest')
            ->description('crear usuario para dar autorizacion a las peticion hacia el hook')
            ->content(
                MediaType::json()->schema(StoreUserRequestSchema::ref())
            );
    }
}

<?php

namespace App\OpenApi\RequestBodies\user;

use App\OpenApi\Schemas\user\LoginSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class LoginRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->description('logearnos en el sistema')
            ->content(MediaType::json()->schema(LoginSchema::ref()));
    }
}

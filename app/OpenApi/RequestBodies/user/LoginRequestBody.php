<?php

namespace App\OpenApi\RequestBodies\user;

use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class LoginRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create();
    }
}

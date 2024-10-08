<?php

namespace App\OpenApi\Schemas\user;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class ResponseStoreUserSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('StoreUserResponse')
            ->properties(
                Schema::boolean('success')->example(true),
                Schema::string('message')->example('Usuario registrado exitosamente.'),
                Schema::string('user')->example('usuario'),
                schema::string('token')->example('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJiIzIiwicHZGI3YTU5NzZmNyJ9.lCfbn8rbDtFzWFTk5rQxip0CxSIGk8ZGu1Sf9TTFy_A')
            );
    }
}

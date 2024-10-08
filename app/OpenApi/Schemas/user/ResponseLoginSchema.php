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

class ResponseLoginSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('ResponseLogin')
            ->properties(
                Schema::string('access_token')->example('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJiIzIiwicHZGI3YTU5NzZmNyJ9.lCfbn8rbDtFzWFTk5rQxip0CxSIGk8ZGu1Sf9TTFy_A')->description('token de autenticacion al webhook'),
                Schema::string('token_type')->example('Bearer')->description('tipo de token'),
                Schema::number('expires_in')->example(3600)->description('tiempo de expiracion del token en segundos.'),
            );
    }
}

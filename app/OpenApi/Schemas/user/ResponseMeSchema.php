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

class ResponseMeSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('ResponseMe')
            ->properties(
                Schema::number('id')->example(3)->description('campo del identificador'),
                Schema::string('name')->example('U53r')->description('nombre del usuario logeado'),
                Schema::string('email')->example('prueba@prueba.com')->description('email del usuario registrado'),
                Schema::string('email_verified_at')->example('2024-09-10T21:07:51.000000Z')->description('si fue verificado el email o no'),
                Schema::string('created_at')->example('2024-09-10T21:07:51.000000Z')->description('fecha de creacion'),
                Schema::string('updated_at')->example('2024-09-10T21:07:51.000000Z')->description('fecha de modificacion')
            );
    }
}

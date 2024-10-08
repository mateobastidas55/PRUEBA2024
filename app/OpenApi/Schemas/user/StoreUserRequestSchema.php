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

class StoreUserRequestSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('StoreUserRequest')
            ->properties(
                Schema::string('name')->example('usuario')->description('campo para almacenar el nombre'),
                Schema::string('email')->example('prueba@prueba.com')->description('campo para almacenar el correo'),
                Schema::string('password')->example('p4sw00rd')->description('campo para almacenar la contraseña'),
            );
    }
}

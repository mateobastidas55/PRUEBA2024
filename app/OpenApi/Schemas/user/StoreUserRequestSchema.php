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
                Schema::string('name')->example('mauricio')->description('campo para almacenar el nombre'),
                Schema::string('lastname')->example('gonzalez')->description('campo para almacenar el apellido'),
                Schema::string('birthday')->example('16/07/1994')->description('campo para almacenar la fecha de nacimiento'),
                Schema::string('notification')->example('whatsapp')->description('campo para almacenar el tipo de notificacion, whatsapp, sms, email'),
                Schema::string('lastname')->example('usuario')->description('campo para almacenar el nombre'),
                Schema::string('email')->example('prueba@prueba.com')->description('campo para almacenar el correo'),
                Schema::string('password')->example('p4sw00rd')->description('campo para almacenar la contraseña'),
            );
    }
}

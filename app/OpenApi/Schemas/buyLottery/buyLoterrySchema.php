<?php

namespace App\OpenApi\Schemas\buyLottery;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable; // Implementar esta interfaz
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class buyLoterrySchema extends SchemaFactory implements Reusable // Aquí agregas "implements Reusable"
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('buyLoterrySchema')
            ->properties(
                Schema::string('package')->example('x3')->description('Campo para almacenar el paquete de lotería.'),
                Schema::string('description')->example('Una de las loterías más antiguas y tradicionales del país.')->description('Descripción del paquete de lotería.'),
                Schema::number('price')->example(177420)->description('Precio del paquete de lotería.')
            );
    }
}

<?php

namespace App\OpenApi\Responses\Lottery;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class buyLotteriesResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    Schema::object('Login')
                        ->properties(
                            Schema::string('message')->example('Lotería de Cundinamarca')->description('Nombre de la lotería o mensaje principal de la respuesta.'),
                            Schema::array('info')
                                ->items(
                                    Schema::object()->properties(
                                        Schema::string('package')->example('x3')->description('Tipo de paquete de la lotería.'),
                                        Schema::number('price')->example(78954)->description('Precio del paquete.')
                                    )
                                )
                                ->description('Lista de paquetes disponibles para la lotería.'),


                        )
                )
            );
    }
}

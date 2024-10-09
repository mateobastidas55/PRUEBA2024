<?php

namespace App\OpenApi\Responses\Lottery;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class LotteryResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    Schema::object('Login')
                        ->properties(
                            Schema::number('id')->example(1)->description('Identificador único del registro de la lotería. Puede ser null al momento de la creación.'),
                            Schema::string('lotteryName')->example('Lotería de Cundinamarca')->description('Nombre de la lotería. Este campo describe la denominación oficial de la lotería.'),
                            Schema::string('description')->example('Una de las loterías más antiguas y tradicionales del país.')->description('Descripción detallada de la lotería. Proporciona información sobre la historia y características de la lotería.'),
                            Schema::boolean('status')->example(1)->description('Estado de la lotería, donde 1 indica que está activa. Este campo puede ser utilizado para determinar si la lotería está en funcionamiento.'),
                            Schema::string('gameRules')->example('Juega con las tres últimas cifras en su orden correcta.')->description('Reglas del juego de la lotería. Explica cómo se puede participar y cuáles son los requisitos para jugar.'),
                            Schema::string('price')->example('20000 COP')->description('campo que almacena el precio de la loteria'),
                        )
                )
            );
    }
}

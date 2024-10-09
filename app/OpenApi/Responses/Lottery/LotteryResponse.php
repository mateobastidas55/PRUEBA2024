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
                    Schema::array('LotteryResponse') // Declaramos que es un array de objetos
                        ->items( // Aquí describimos las propiedades de cada objeto del array
                            Schema::object()
                                ->properties(
                                    Schema::integer('id')->example(1)->description('Identificador único del registro de la lotería.'),
                                    Schema::string('lotteryName')->example('Lotería de Cundinamarca')->description('Nombre de la lotería.'),
                                    Schema::string('description')->example('Una de las loterías más antiguas y tradicionales del país.')->description('Descripción detallada de la lotería.'),
                                    Schema::boolean('status')->example(1)->description('Estado de la lotería, donde 1 indica que está activa.'),
                                    Schema::string('gameRules')->example('Juega con las tres últimas cifras en su orden correcta.')->description('Reglas del juego de la lotería.'),
                                    Schema::string('price')->example('86278')->description('Precio de la lotería en pesos.'),
                                    Schema::string('created_at')->example('2024-10-09 07:52:05')->description('Fecha de creación de la lotería.'),
                                    Schema::string('updated_at')->example('2024-10-09 07:52:05')->description('Fecha de actualización de la lotería.')
                                )
                        )
                )
            );
    }
}

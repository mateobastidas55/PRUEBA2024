<?php

namespace App\OpenApi\Responses\Admin;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class IndexAdminControllerResponse extends ResponseFactory
{
    public function build(): Response
    {

        return Response::ok()->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    Schema::array('IndexAdminControllerResponse') 
                        ->items( // Describe las propiedades de cada objeto del array
                            Schema::object()
                                ->properties(
                                    Schema::string('id')
                                        ->example('00001')
                                        ->description('Identificador único del registro de la lotería.'),
                                    Schema::integer('loteryId')
                                        ->example(1)
                                        ->description('Identificador de la lotería a la que corresponde este sorteo.'),
                                    Schema::string('gameDate')
                                        ->example('2024-11-02 00:00:00')
                                        ->description('Fecha y hora en que se llevará a cabo el juego.'),
                                    Schema::number('totalPrize')
                                        ->example(86278)
                                        ->description('Total del premio en pesos que se sortea.'),
                                    Schema::string('status')
                                        ->example('Pendiente')
                                        ->description('Estado actual del sorteo. Puede ser "Pendiente", "Finalizado", etc.'),
                                    Schema::string('winner')
                                        ->nullable() // Indica que este campo puede ser nulo
                                        ->example(null)
                                        ->description('Identificador del ganador, si existe. Puede ser nulo si aún no hay ganador.'),
                                    Schema::string('createdAt')
                                        ->example('2024-10-09T07:52:05.000000Z')
                                        ->description('Fecha y hora en que se creó el registro del sorteo.'),
                                    Schema::string('updatedAt')
                                        ->example('2024-10-09T07:52:05.000000Z')
                                        ->description('Fecha y hora en que se actualizó por última vez el registro del sorteo.')
                                )
                        )
                )
            );
    }
}

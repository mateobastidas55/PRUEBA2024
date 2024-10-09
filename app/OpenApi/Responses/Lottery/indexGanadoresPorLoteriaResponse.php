<?php

namespace App\OpenApi\Responses\Lottery;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class indexGanadoresPorLoteriaResponse extends ResponseFactory
{
    public function build(): Response
    {

        return Response::ok()->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    Schema::array('indexGanadoresPorLoteriaResponse')
                        ->items(
                            Schema::object()
                                ->properties(
                                    Schema::string('id')->example('00856')->description('Identificador único del ganador de la lotería.'),
                                    Schema::string('lottery_name')->example('Lotería de Cundinamarca')->description('Nombre de la lotería en la que participó el ganador.'),
                                    Schema::number('reward')->example(83496187573)->description('Total del premio ganado por el participante.'),
                                    Schema::string('date')->example('2024-10-09 07:58:37')->description('Fecha y hora en que se realizó la lotería.')
                                )
                        )
                )
            );
    }
}

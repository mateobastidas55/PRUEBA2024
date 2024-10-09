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
                            Schema::boolean('success')->example('true')->description('Indica si la solicitud fue exitosa.'),
                            Schema::array('lotteries')->example(["0001", "0002", "0003"])->description(' Un array que contiene los identificadores únicos de las loterías disponibles.'),
                        )
                )
            );
    }
}

<?php

namespace App\OpenApi\Responses\Lottery;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PHPUnit\Framework\Attributes\Medium;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class showLotteriesPorLoteResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
        ->content(
            MediaType::json()->schema(
                Schema::object('showLotteriesPorLoteResponse')
                    ->properties(
                        Schema::string('message')
                            ->example('Lotería de Cundinamarca')
                            ->description('Nombre de la lotería. Este campo describe la denominación oficial de la lotería.'),
    
                        Schema::array('info')
                            ->items(
                                Schema::object()
                                    ->properties(
                                        Schema::string('package')
                                            ->example('x1')
                                            ->description('Paquete de la lotería (cantidad de boletos o tipo de paquete).'),
    
                                        Schema::string('description')
                                            ->example('Una de las loterías más antiguas y tradicionales del país.')
                                            ->description('Descripción detallada del paquete de lotería.'),
    
                                        Schema::number('price')
                                            ->example(58235)
                                            ->description('Precio del paquete de lotería.')
                                    )
                            )
                            ->description('Lista de paquetes disponibles con descripción y precio.')
                    )
            )
        );
    
    }
}

<?php

namespace App\OpenApi\Responses\Admin;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class showAdminControllerResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
    ->content(
        MediaType::json()->schema(
            Schema::object('IndexAdminControllerResponse')
                ->properties(
                    Schema::array('data') // Aseguramos que data sea un array
                        ->items(
                            Schema::object()
                                ->properties(
                                    Schema::string('id')
                                        ->example('1')
                                        ->description('Identificador único del usuario.'),
                                    Schema::string('name')
                                        ->example('Cristian')
                                        ->description('Nombre del usuario.'),
                                    Schema::string('email')
                                        ->example('dextter1913@gmail.com')
                                        ->description('Correo electrónico del usuario.'),
                                    Schema::string('birthDate')
                                        ->example('1970-11-14')
                                        ->description('Fecha de nacimiento del usuario en formato YYYY-MM-DD.'),
                                    Schema::integer('status')
                                        ->example(1)
                                        ->description('Estado del usuario, donde 1 indica que está activo.'),
                                    Schema::string('phone')
                                        ->example('3167777777')
                                        ->description('Número de teléfono del usuario.'),
                                    Schema::integer('notifyBy')
                                        ->example(1)
                                        ->description('Método de notificación preferido por el usuario.'),
                                    Schema::object('role') // Definimos el objeto role aquí
                                        ->properties(
                                            Schema::integer('id')
                                                ->example(1)
                                                ->description('Identificador único del rol del usuario.'),
                                            Schema::string('name')
                                                ->example('admin')
                                                ->description('Nombre del rol del usuario.')
                                        ),
                                    Schema::string('createdAt')
                                        ->example('2024-10-09T07:52:05.000000Z')
                                        ->description('Fecha y hora en que se creó el registro del usuario.'),
                                    Schema::string('updatedAt')
                                        ->example('2024-10-09T07:52:05.000000Z')
                                        ->description('Fecha y hora en que se actualizó por última vez el registro del usuario.')
                                )
                        )
                )
        )
    );


    }
}

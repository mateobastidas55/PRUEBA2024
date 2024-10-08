<?php

namespace App\OpenApi\Responses\Notifications;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class NotificationMethodResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->description('Successful response')
            ->content(
                MediaType::json()->schema(
                    Schema::object('Login')
                        ->properties(
                            Schema::string('id')->example('prueba@prueba.com')->description('este campo trae el id del metodo de notificacion'),
                            Schema::string('notificationMethodName')->example('p4sw00rd')->description('este campo trae el nombre del metodo de notificacion'),
                        )
                )
            );
    }
}

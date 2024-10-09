<?php

namespace App\OpenApi\RequestBodies\buyLottery;

use App\OpenApi\Schemas\buyLottery\buyLoterrySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class buyLotteryRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('buyLotteryRequestBody')
            ->description('crear la compra de una loteria')
            ->content(
                MediaType::json()->schema(buyLoterrySchema::ref())
            );
    }
}

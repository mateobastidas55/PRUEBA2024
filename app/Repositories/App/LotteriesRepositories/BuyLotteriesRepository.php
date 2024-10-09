<?php

namespace App\Repositories\App\LotteriesRepositories;

use App\Models\Lottery;
use App\Repositories\Interfaces\LotteriesInterfaces\BuyLotteriesInterface;

class BuyLotteriesRepository implements BuyLotteriesInterface
{
    public function show(int $id): array
    {
        $lotteries = new Lottery();

        $res = $lotteries::where('id', $id)->first();

        return [
            'message' => $res->lottery_name,
            'info' => [
                [
                    'package' => 'x1',
                    'description' => $res->description,
                    'price' => $res->price,
                ],
                [
                    'package' => 'x3',
                    'description' => $res->description,
                    'price' => $res->price * 3,
                ],
                [
                    'package' => 'x5',
                    'description' => $res->description,
                    'price' => $res->price * 5,
                ],
                [
                    'package' => 'x10',
                    'description' => $res->description,
                    'price' => $res->price * 10,
                ]
            ]
        ];
    }

    public function update(int $id, array $request): object
    {
        return new class {};
    }
}

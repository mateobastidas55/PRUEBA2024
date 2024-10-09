<?php

namespace App\Repositories\App\LotteriesRepositories;

use App\Models\Lottery;
use App\Repositories\Interfaces\LotteriesInterfaces\BuyLotteriesInterface;

class BuyLotteriesRepository implements BuyLotteriesInterface
{
    public function show(string $id): array
    {
        $lotteries = new Lottery();

        $res = $lotteries::where('id', $id)->first();

        return [
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
        ];
        return new class {};
    }

    public function update(string $id, array $request): object
    {
        return new class {};
    }
}

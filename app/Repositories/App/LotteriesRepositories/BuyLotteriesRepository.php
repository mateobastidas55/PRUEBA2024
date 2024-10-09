<?php

namespace App\Repositories\App\LotteriesRepositories;

use App\Models\GamesLottery;
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
        $gamesLottery = new GamesLottery();
        switch ($request['package']) {
            case 'x1':
                $first = $gamesLottery::where('id_lottery', $id)
                    ->where('id_user', '=', null)
                    ->first();
                $first->update(
                    [
                        'id_user' => $request['info']['id']
                    ]
                );
                break;
            case 'x3':
                $count = [1, 2, 3];
                foreach ($count as $i) {
                    $first = $gamesLottery::where('id_lottery', $id)
                        ->where('id_user', '=', null)
                        ->first();
                    $first->update(
                        [
                            'id_user' => $request['info']['id']
                        ]
                    );
                    $res[] = $first;
                }
                dd($res);

                break;
            case 'x5':
                # code...
                break;
            case 'x10':
                # code...
                break;
            default:
                # code...
                break;
        }
        return new class {};
    }
}

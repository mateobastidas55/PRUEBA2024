<?php

namespace App\Repositories\App\LotteriesRepositories;

use App\Models\GamesLottery;
use App\Models\Lottery;
use App\Repositories\Interfaces\LotteriesInterfaces\BuyLotteriesInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BuyLotteriesRepository implements BuyLotteriesInterface
{

    public function index(): array
    {
        $winners = GamesLottery::where('winner', 1)
            ->join('lottery As b', 'games_lottery.id_lottery', '=', 'b.id')
            ->select('games_lottery.id', 'b.lottery_name', 'games_lottery.reward', 'games_lottery.updated_at')
            ->get()
            ->toArray();

        foreach ($winners as $winner) {
            $res[] = [
                'id' => str_pad($winner['id'], 5, '0', STR_PAD_LEFT),
                'lottery_name' => $winner['lottery_name'],
                'reward' => $winner['reward'],
                'date' => Carbon::parse($winner['updated_at'])->format('Y-m-d H:i:s'),
            ];
        }

        return $res;
    }

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

    public function update(int $id, array $request): array
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
                    $res[] = str_pad($first->toArray()['id'], 5, '0', STR_PAD_LEFT);
                }
                break;
            case 'x5':
                $count = [1, 2, 3, 4, 5];
                foreach ($count as $i) {
                    $first = $gamesLottery::where('id_lottery', $id)
                        ->where('id_user', '=', null)
                        ->first();
                    $first->update(
                        [
                            'id_user' => $request['info']['id']
                        ]
                    );
                    $res[] = str_pad($first->toArray()['id'], 5, '0', STR_PAD_LEFT);
                }
                break;
            case 'x10':
                $count = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                foreach ($count as $i) {
                    $first = $gamesLottery::where('id_lottery', $id)
                        ->where('id_user', '=', null)
                        ->first();
                    $first->update(
                        [
                            'id_user' => $request['info']['id']
                        ]
                    );
                    $res[] = str_pad($first->toArray()['id'], 5, '0', STR_PAD_LEFT);
                }
                break;
            default:
                $res = [];
                break;
        }
        return [
            'success' => true,
            'lotteries' => $res
        ];
    }
}

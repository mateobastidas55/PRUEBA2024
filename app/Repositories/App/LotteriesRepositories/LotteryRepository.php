<?php

namespace App\Repositories\App\LotteriesRepositories;

use App\Models\Lottery;
use App\Repositories\Interfaces\LotteriesInterfaces\LotteryInterface;

class LotteryRepository implements LotteryInterface
{
	public function index(): object
	{
		$lotteries = Lottery::get();
		return $lotteries;
	}
}

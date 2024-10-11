<?php

namespace App\Console\Commands;

use App\Mail\WinnerMail;
use App\Models\GamesLottery;
use App\Models\Lottery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RunGameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-game-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'comando para ejecutar juego';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lotteries = Lottery::select('id')->get()->toArray();
        $gamesLotteries = new GamesLottery();
        foreach ($lotteries as $lottery) {
            $winnersId[] = $gamesLotteries::where('id_lottery', $lottery['id'])->get()->random()->toArray();
        }
        foreach ($winnersId as $winnerId) {
            $gamesLotteries::where('id', $winnerId['id'])->update(['winner' => true]);
            Mail::to('pmanager@aveonline.co')->send(new WinnerMail($winnerId['id']));
        }
        echo 'congratulations to the winners';
    }
}

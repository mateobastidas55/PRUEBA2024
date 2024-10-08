<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesLottery extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_lottery',
        'game_date',
        'reward',
        'id_user'
    ];

    protected $table = 'games_lottery';
}

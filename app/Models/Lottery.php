<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    protected $fillable = [
        'lottery_name',
        'description',
        'status',
        'game_rules',
        'price'
    ];

    protected $table = 'lottery';
}

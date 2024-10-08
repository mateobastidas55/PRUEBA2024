<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GamesLottery>
 */
class GamesLotteryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $lotteryNames = [
            'Lotería de Cundinamarca',
            'Lotería del Tolima',
            'Baloto',
            'Cafeterito',
            'La Caribeña Día y Noche',
            'El Dorado',
            'Chontico',
            'ColorLOTO',
            'Extra Lotería de Bogotá',
            'Extra Lotería de Boyacá',
            'Extra Lotería de Medellín',
            'Extra Lotería de Santander',
            'Extra Lotería del Cauca',
            'La Culona',
            'La Fantástica',
            'Antioqueñita',
            'Paisa Lotto',
            'Motilón',
            'Pijao de Oro',
            'Cruz Roja'
        ];

        return [
            //
        ];
    }
}

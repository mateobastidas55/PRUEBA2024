<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LotteryFactory extends Factory
{
    /**
     * Define the model's default state.
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

        $descriptions = [
            'Lotería de Cundinamarca' => 'Una de las loterías más antiguas y tradicionales del país.',
            'Lotería del Tolima' => 'Conocida por sus premios atractivos y su popularidad en la región.',
            'Baloto' => 'Una de las loterías más grandes y populares, con premios significativos.',
            'Cafeterito' => 'Popular en la región cafetera, con un enfoque en apoyar a la comunidad cafetera.',
            'La Caribeña Día y Noche' => 'Ofrece sorteos diarios y nocturnos con premios variados.',
            'El Dorado' => 'Conocida por sus altos premios y su nombre inspirado en la leyenda del El Dorado.',
            'Chontico' => 'Popular en la región del Valle del Cauca.',
            'ColorLOTO' => 'Ofrece una experiencia de juego colorida y emocionante.',
            'Extra Lotería de Bogotá' => 'Una versión especial de la lotería de Bogotá con premios adicionales.',
            'Extra Lotería de Boyacá' => 'Similar a la de Bogotá, pero enfocada en la región de Boyacá.',
            'Extra Lotería de Medellín' => 'Con premios adicionales para los jugadores de Medellín.',
            'Extra Lotería de Santander' => 'Ofrece premios adicionales para los jugadores de Santander.',
            'Extra Lotería del Cauca' => 'Con premios adicionales para los jugadores del Cauca.',
            'La Culona' => 'Conocida por su nombre llamativo y sus premios atractivos.',
            'La Fantástica' => 'Ofrece una variedad de premios y sorteos emocionantes.',
            'Antioqueñita' => 'Popular en la región de Antioquia.',
            'Paisa Lotto' => 'Con un enfoque en la comunidad paisa.',
            'Motilón' => 'Popular en la región de Santander.',
            'Pijao de Oro' => 'Conocida por sus premios y su nombre inspirado en la cultura local.',
            'Cruz Roja' => 'Colabora con la Cruz Roja Colombiana para financiar servicios humanitarios.'
        ];

        $status = [true, false];

        $gameRules = [
            'Lotería de Cundinamarca' => 'Juega con las tres últimas cifras en su orden correcta.',
            'Lotería del Tolima' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Baloto' => 'Juega con las cuatro últimas cifras y el número de serie.',
            'Cafeterito' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'La Caribeña Día y Noche' => 'Juega con las tres últimas cifras en su orden correcta.',
            'El Dorado' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Chontico' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'ColorLOTO' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Extra Lotería de Bogotá' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Extra Lotería de Boyacá' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Extra Lotería de Medellín' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Extra Lotería de Santander' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Extra Lotería del Cauca' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'La Culona' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'La Fantástica' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Antioqueñita' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Paisa Lotto' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Motilón' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Pijao de Oro' => 'Juega con las cuatro últimas cifras en cualquier orden.',
            'Cruz Roja' => 'Juega con las cuatro últimas cifras en cualquier orden.'
        ];

        $lottery = fake()->randomElement($lotteryNames);


        return [
            'lottery_name' => $lottery,
            'description' => $descriptions[$lottery],
            'status' => fake()->randomElement($status),
            'game_rules' => $gameRules[$lottery],
        ];
    }
}

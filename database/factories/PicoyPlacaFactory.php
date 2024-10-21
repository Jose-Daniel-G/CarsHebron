<?php

namespace Database\Factories;

use App\Models\PicoyPlaca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PicoyPlaca>
 */
class PicoyPlacaFactory extends Factory
{
    protected $model = PicoyPlaca::class;

    public function definition()
    {
        return [
            'fecha_inicio' => $this->faker->date(), // Fecha de inicio de la restricción
            'fecha_fin' => $this->faker->date(), // Fecha de fin de la restricción
            'dia' => $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes']), // Días aplicables
            'horario' => $this->faker->randomElement(['07:00:00', '08:00:00']), // Horario entre 7 AM y 8 PM
            'placas_reservadas' => $this->faker->randomElement(['7 y 8', '9 y 0', '1 y 2', '3 y 4', '5 y 6']), // Ejemplo de placas reservadas
        ];
    }

}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
					'full_name' => $this->faker->name(),
					'company_name' => $this->faker->company(),
					'phone_number' => $this->faker->unique()->numerify('+7-(926)-###-##-##'),
					'email' => $this->faker->unique()->safeEmail(),
					'date_of_birth' => $this->faker->date()
        ];
    }
}

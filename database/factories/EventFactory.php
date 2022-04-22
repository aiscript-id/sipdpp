<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(3);
        return [
            'name' => $title,
            'slug' => \Str::slug($title),
            'description' => $this->faker->paragraph(3),
            'date' => $this->faker->date('Y-m-d'),
            'start_time' =>  $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'location' =>  $this->faker->address,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}

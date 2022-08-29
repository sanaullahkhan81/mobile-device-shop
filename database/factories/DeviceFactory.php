<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $releaseDate = Carbon::today()->subDays(rand(0, 365));

        return [
            'model' => $this->faker->name(),
            'brand' => $this->faker->name(),
            'release_date' => $releaseDate->format('Y/d'),
            'os' => $this->faker->name(),
            'is_new' => rand(0, 1),
            'received_datetime' => ''
        ];
    }
}

<?php

namespace Database\Factories\Admin;

use App\Models\Admin\SubTask_M;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubTask_MFactory extends Factory
{
    protected $model = SubTask_M::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'date_ar' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'time' => $this->faker->dateTime()->format('H:i'),
            // You may define other attributes here
        ];
    }
}

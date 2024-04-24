<?php

namespace Database\Factories;

use App\Models\MainData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=MainData>
 */
class MainDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = MainData::class;
    public function definition(): array
    {
        return [
          'image'=>$this->faker->imageUrl,
          'name'=>$this->faker->name,
          'email'=>$this->faker->unique()->safeEmail,
          'address'=>$this->faker->address,
          'phone'=>$this->faker->phoneNumber,
          'description'=>$this->faker->text,
        ];
    }
}

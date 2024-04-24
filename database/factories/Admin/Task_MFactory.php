<?php

namespace Database\Factories\Admin;

use App\Models\Admin\SubTask_M;
use App\Models\Admin\Task_M;
use Illuminate\Database\Eloquent\Factories\Factory;

class Task_MFactory extends Factory
{
    protected $model = Task_M::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Task_M $task) {
            SubTask_M::factory()->count(5)->create([
                'main_task_id' => $task->id,
            ]);
        });
    }
}

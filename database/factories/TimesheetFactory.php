<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timesheet>
 */
class TimesheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task_name' => fake()->name(),
            'project_id' => Project::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'timesheet_date' => fake()->date(),
            'timesheet_hours' => fake()->numberBetween(1, 15),
        ];
    }
}

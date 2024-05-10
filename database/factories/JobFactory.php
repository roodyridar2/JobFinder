<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'category' => $this->faker->randomElement(['IT', 'Health', 'Telecom', 'Development', 'Others']),
            'job_region' => $this->faker->city,
            'job_type' => $this->faker->randomElement(['Part-time', 'Full-time', 'Contract', 'Internship', 'Temporary']),
            'experience' => $this->faker->text,
            'salary' => $this->faker->numberBetween(50, 200),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'application_deadline' => $this->faker->date,
            'jobdescription' => $this->faker->paragraph(4),
            'responsibilities' => $this->faker->paragraph,
            'education_experience' => $this->faker->paragraph,
            // 'image' => '',
            // 'image' => 'https://picsum.photos/800/400',
        ];
    }
}

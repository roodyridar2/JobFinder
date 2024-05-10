<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Categories;
use App\Models\JobType;
use App\Models\Admin;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $job_type = ['Part-time', 'Full-time', 'Contract', 'Internship', 'Temporary'];
        $categories = ['IT',  'Health', 'Telecom', 'Development', 'Others'];

        foreach ($job_type as $type) {
           JobType::create(['job_type' => $type]);
        }

        foreach ($categories as $category) {
            Categories::create(['name' => $category]);
        }
        Job::factory()->count(50)->create();

        Admin::factory()->count(1)->create();


    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('timesheets')->truncate();
        DB::table('users')->truncate();
        DB::table('projects')->truncate();
        DB::table('departments')->truncate();
        User::factory()->create();
        Department::factory(5)->create();
        Project::factory(5)->create();
        Timesheet::factory(8)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

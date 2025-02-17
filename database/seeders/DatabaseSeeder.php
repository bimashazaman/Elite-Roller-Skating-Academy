<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // First create the admin user
        $this->call(AdminUserSeeder::class);

        // Then create sample blogs
        $this->call(BlogSeeder::class);

        // Finally create sample admissions
        $this->call(AdmissionSeeder::class);
    }
}

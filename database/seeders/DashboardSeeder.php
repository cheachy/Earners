<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create a Clerk (Admin) - To manage the system
        $admin = \App\Models\User::create([
            'name' => 'Admin Clerk',
            'email' => 'admin@earners.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        // Create a profile for the admin so they can log in via contact number too
        \App\Models\FisherProfile::create([
            'user_id' => $admin->id,
            'contact_number' => '000',
            'location_zone' => 'Office',
            'preferred_payment' => 'N/A'
        ]);

        // 2. Create a Fisherman (John Peterson)
        $john = \App\Models\User::create([
            'name' => 'John Peterson',
            'email' => '09171234567@earners.com', // Match your new logic
            'password' => bcrypt('password'),
            'role' => 'fisherman'
        ]);

        $johnProfile = \App\Models\FisherProfile::create([
            'user_id' => $john->id,
            'contact_number' => '09171234567',
            'location_zone' => 'North Dock',
            'preferred_payment' => 'Cash'
        ]);

        // 3. Create a "Pending" SMS Catch for John (to show in your new dashboard)
        \App\Models\CatchLog::create([
            'fisher_profile_id' => $johnProfile->id,
            'species' => 'Tuna',
            'declared_weight' => 45.5,
            'status' => 'pending',
            'date_caught' => now()
        ]);
    }
}

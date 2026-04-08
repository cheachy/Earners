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
        // Create a User and Profile
        $user = \App\Models\User::create([
            'name' => 'John Peterson',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'fisherman'
        ]);

        $profile = \App\Models\FisherProfile::create([
            'user_id' => $user->id,
            'contact_number' => '123456789',
            'location_zone' => 'North Bay',
            'preferred_payment' => 'G-Cash'
        ]);

        // Create a Catch Log
        $catch = \App\Models\CatchLog::create([
            'fisher_profile_id' => $profile->id,
            'species' => 'Tuna',
            'weight_kg' => 520,
            'quality_grade' => 'A',
            'date_caught' => now(),
            'status' => 'sold'
        ]);

        // Create a Sale
        \App\Models\Sale::create([
            'catch_log_id' => $catch->id,
            'buyer_name' => 'Local Market',
            'price_per_kg' => 4.50,
            'total_amount' => 2340,
            'sale_date' => now(),
            'payout_status' => 'pending'
        ]);
    }
}

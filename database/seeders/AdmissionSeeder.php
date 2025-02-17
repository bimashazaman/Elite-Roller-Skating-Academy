<?php

namespace Database\Seeders;

use App\Models\Admission;
use Illuminate\Database\Seeder;

class AdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admissions = [
            [
                'full_name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1234567890',
                'date_of_birth' => '2005-03-15',
                'gender' => 'male',
                'address' => '123 Sports Street',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'postal_code' => '10001',
                'sport_interest' => 'Basketball',
                'experience_level' => 'Intermediate',
                'medical_conditions' => null,
                'emergency_contact_name' => 'Mary Smith',
                'emergency_contact_phone' => '+1234567891',
                'preferred_training_time' => 'Evening',
                'additional_notes' => 'Interested in joining the competitive team',
                'status' => 'pending',
            ],
            [
                'full_name' => 'Emma Johnson',
                'email' => 'emma.johnson@example.com',
                'phone' => '+1234567892',
                'date_of_birth' => '2007-07-22',
                'gender' => 'female',
                'address' => '456 Athletic Avenue',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'country' => 'USA',
                'postal_code' => '90001',
                'sport_interest' => 'Swimming',
                'experience_level' => 'Advanced',
                'medical_conditions' => 'Mild asthma',
                'emergency_contact_name' => 'Robert Johnson',
                'emergency_contact_phone' => '+1234567893',
                'preferred_training_time' => 'Morning',
                'additional_notes' => 'Former competitive swimmer',
                'status' => 'approved',
            ],
            [
                'full_name' => 'Michael Chen',
                'email' => 'michael.chen@example.com',
                'phone' => '+1234567894',
                'date_of_birth' => '2006-11-30',
                'gender' => 'male',
                'address' => '789 Sports Complex',
                'city' => 'Chicago',
                'state' => 'IL',
                'country' => 'USA',
                'postal_code' => '60601',
                'sport_interest' => 'Tennis',
                'experience_level' => 'Beginner',
                'medical_conditions' => null,
                'emergency_contact_name' => 'Lisa Chen',
                'emergency_contact_phone' => '+1234567895',
                'preferred_training_time' => 'Afternoon',
                'additional_notes' => 'Would like to focus on serving techniques',
                'status' => 'pending',
            ],
            [
                'full_name' => 'Sarah Williams',
                'email' => 'sarah.williams@example.com',
                'phone' => '+1234567896',
                'date_of_birth' => '2004-09-18',
                'gender' => 'female',
                'address' => '321 Training Center',
                'city' => 'Miami',
                'state' => 'FL',
                'country' => 'USA',
                'postal_code' => '33101',
                'sport_interest' => 'Volleyball',
                'experience_level' => 'Professional',
                'medical_conditions' => 'Previous knee injury (fully recovered)',
                'emergency_contact_name' => 'David Williams',
                'emergency_contact_phone' => '+1234567897',
                'preferred_training_time' => 'Evening',
                'additional_notes' => 'Looking to join the elite training program',
                'status' => 'approved',
            ],
        ];

        foreach ($admissions as $admission) {
            Admission::create($admission);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Institute;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $instituteAdminRole = Role::firstOrCreate(['name' => 'Institute Admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'Teacher']);
        $receptionistRole = Role::firstOrCreate(['name' => 'Receptionist']);
        $studentRole = Role::firstOrCreate(['name' => 'Student']);

        // 2. Super Admin User
        User::firstOrCreate(
        ['email' => 'superadmin@educore.com'],
        [
            'name' => 'System Owner',
            'password' => Hash::make('password'),
            'role_id' => $superAdminRole->id,
            'institute_id' => null,
        ]
        );

        // 3. Subscription Plans
        $proPlan = Plan::firstOrCreate(
        ['name' => 'Basic Plan'],
        [
            'price' => 999.00,
            'duration_days' => 30,
            'is_active' => true,
        ]
        );

        // 4. Sample Institute
        $institute = Institute::firstOrCreate(
        ['subdomain' => 'apex'],
        [
            'name' => 'Apex Coaching Center',
            'contact_email' => 'contact@apexcoaching.com',
            'phone' => '9876543210',
            'is_active' => true,
        ]
        );

        // Active subscription for Institute
        $institute->subscriptions()->firstOrCreate(
        ['plan_id' => $proPlan->id, 'status' => 'active'],
        [
            'starts_at' => now(),
            'ends_at' => now()->addDays(30),
        ]
        );

        // 5. Active test data for Apex
        $batch = \App\Models\Batch::firstOrCreate(
        ['institute_id' => $institute->id, 'name' => 'Class 10 - Morning Batch'],
        [
            'schedule_time' => 'Mon-Wed-Fri 10:00 AM',
            'is_active' => true,
        ]
        );

        \App\Models\FeeStructure::firstOrCreate(
        ['institute_id' => $institute->id, 'name' => 'Annual Coaching Fee'],
        [
            'total_amount' => 12000.00,
            'description' => 'Includes all subjects',
        ]
        );

        // 6. Institute Admin
        User::firstOrCreate(
        ['email' => 'admin@apexcoaching.com'],
        [
            'name' => 'Apex Admin',
            'password' => Hash::make('password'),
            'role_id' => $instituteAdminRole->id,
            'institute_id' => $institute->id,
        ]
        );

        // 7. Teacher
        User::firstOrCreate(
        ['email' => 'teacher@apexcoaching.com'],
        [
            'name' => 'Jane Teacher',
            'password' => Hash::make('password'),
            'role_id' => $teacherRole->id,
            'institute_id' => $institute->id,
        ]
        );

        // 8. Receptionist
        User::firstOrCreate(
        ['email' => 'receptionist@apexcoaching.com'],
        [
            'name' => 'Mike Receptionist',
            'password' => Hash::make('password'),
            'role_id' => $receptionistRole->id,
            'institute_id' => $institute->id,
        ]
        );

        User::firstOrCreate(
        ['email' => 'student@edu.com'],
        [
            'name' => 'Abid Saiyed',
            'password' => Hash::make('password'),
            'role_id' => $studentRole->id,
            'institute_id' => $institute->id,
        ]
        );
    }
}

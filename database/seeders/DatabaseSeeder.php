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
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $instituteAdminRole = Role::create(['name' => 'Institute Admin']);
        $teacherRole = Role::create(['name' => 'Teacher']);
        $receptionistRole = Role::create(['name' => 'Receptionist']);
        $studentRole = Role::create(['name' => 'Student']);

        // 2. Super Admin User
        User::create([
            'name' => 'System Owner',
            'email' => 'superadmin@educore.com',
            'password' => Hash::make('password'),
            'role_id' => $superAdminRole->id,
            'institute_id' => null, // Super Admins don't belong to a single institute
        ]);

        // 3. Subscription Plans
        Plan::create([
            'name' => 'Basic Plan',
            'price' => 999.00,
            'duration_days' => 30,
            'is_active' => true,
        ]);

        // 4. Sample Institute
        $institute = Institute::create([
            'name' => 'Apex Coaching Center',
            'subdomain' => 'apex',
            'contact_email' => 'contact@apexcoaching.com',
            'phone' => '9876543210',
            'is_active' => true,
        ]);

        // Active subscription for Institute
        $institute->subscriptions()->create([
            'plan_id' => $proPlan->id,
            'starts_at' => now(),
            'ends_at' => now()->addDays(30),
            'status' => 'active',
        ]);

        // 5. Active test data for Apex
        $batch = \App\Models\Batch::create([
            'institute_id' => $institute->id,
            'name' => 'Class 10 - Morning Batch',
            'schedule_time' => 'Mon-Wed-Fri 10:00 AM',
            'is_active' => true,
        ]);

        \App\Models\FeeStructure::create([
            'institute_id' => $institute->id,
            'name' => 'Annual Coaching Fee',
            'total_amount' => 12000.00,
            'description' => 'Includes all subjects',
        ]);

        // 6. Institute Admin
        User::create([
            'name' => 'Apex Admin',
            'email' => 'admin@apexcoaching.com',
            'password' => Hash::make('password'),
            'role_id' => $instituteAdminRole->id,
            'institute_id' => $institute->id,
        ]);

        // 7. Teacher
        User::create([
            'name' => 'Jane Teacher',
            'email' => 'teacher@apexcoaching.com',
            'password' => Hash::make('password'),
            'role_id' => $teacherRole->id,
            'institute_id' => $institute->id,
        ]);

        // 8. Receptionist
        User::create([
            'name' => 'Mike Receptionist',
            'email' => 'receptionist@apexcoaching.com',
            'password' => Hash::make('password'),
            'role_id' => $receptionistRole->id,
            'institute_id' => $institute->id,
        ]);

        User::create([
            'name' => 'Abid Saiyed',
            'email' => 'student@edu.com',
            'password' => Hash::make('password'),
            'role_id' => $studentRole->id,
            'institute_id' => $institute->id,
        ]);
    }
}

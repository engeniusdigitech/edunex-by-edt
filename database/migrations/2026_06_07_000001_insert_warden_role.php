<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Role;
use App\Models\User;
use App\Models\Institute;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Insert Warden Role
        $wardenRole = Role::firstOrCreate(['name' => 'Warden']);

        // 2. Find Apex Institute
        $institute = Institute::where('subdomain', 'apex')->first();
        if ($institute) {
            // 3. Create Sample Warden User
            User::firstOrCreate(
                ['email' => 'warden@apexinstitute.com'],
                [
                    'name' => 'John Warden',
                    'password' => Hash::make('password'),
                    'role_id' => $wardenRole->id,
                    'institute_id' => $institute->id,
                ]
            );
        }
    }

    public function down(): void
    {
        User::where('email', 'warden@apexinstitute.com')->delete();
        Role::where('name', 'Warden')->delete();
    }
};

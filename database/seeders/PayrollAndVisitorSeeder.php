<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\StaffSalary;
use App\Models\StaffAttendance;
use App\Models\LeaveRequest;
use App\Models\Visitor;
use Carbon\Carbon;

class PayrollAndVisitorSeeder extends Seeder
{
    public function run(): void
    {
        $instituteId = \App\Models\Institute::first()->id ?? 1;

        // 1. Setup Salary Structure for Jane Teacher
        $teacher = User::where('email', 'teacher@apexinstitute.com')->first();
        if ($teacher) {
            // Remove previous salary structures to avoid duplicates
            StaffSalary::where('user_id', $teacher->id)->update(['is_active' => false]);

            $salary = StaffSalary::create([
                'institute_id' => $instituteId,
                'user_id' => $teacher->id,
                'basic_salary' => 30000.00,
                'hra' => 6000.00,
                'allowances' => 4000.00,
                'deductions' => 1000.00,
                'pf_rate' => 12.00, // 12% of basic
                'esic_rate' => 0.75, // 0.75% of gross
                'cl_allowance' => 12,
                'el_allowance' => 18,
                'effective_from' => Carbon::now()->startOfYear(),
                'is_active' => true,
            ]);

            // Seed Attendance logs for Current Month: 20 present days
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $start = Carbon::create($currentYear, $currentMonth, 1)->startOfMonth();
            
            // Seed 20 present days
            for ($d = 1; $d <= 20; $d++) {
                $date = $start->copy()->addDays($d - 1);
                StaffAttendance::firstOrCreate(
                    [
                        'user_id' => $teacher->id,
                        'date' => $date->toDateString(),
                    ],
                    [
                        'institute_id' => $instituteId,
                        'status' => 'present',
                        'mark_in_at' => $date->copy()->hour(9)->minute(0),
                        'mark_out_at' => $date->copy()->hour(17)->minute(0),
                        'mark_in_latitude' => 28.6139,
                        'mark_in_longitude' => 77.2090,
                    ]
                );
            }

            // Seed 3 Approved Casual Leave Days
            $leaveStart = $start->copy()->addDays(21);
            $leaveEnd = $start->copy()->addDays(23);
            LeaveRequest::firstOrCreate(
                [
                    'user_id' => $teacher->id,
                    'start_date' => $leaveStart->toDateString(),
                ],
                [
                    'institute_id' => $instituteId,
                    'type' => 'Casual Leave',
                    'end_date' => $leaveEnd->toDateString(),
                    'reason' => 'Family occasion and personal work.',
                    'status' => 'approved',
                    'status_updated_at' => Carbon::now(),
                ]
            );
        }

        // 2. Setup Salary Structure for Mike Receptionist
        $receptionist = User::where('email', 'receptionist@apexinstitute.com')->first();
        if ($receptionist) {
            StaffSalary::where('user_id', $receptionist->id)->update(['is_active' => false]);

            StaffSalary::create([
                'institute_id' => $instituteId,
                'user_id' => $receptionist->id,
                'basic_salary' => 15000.00,
                'hra' => 3000.00,
                'allowances' => 2000.00,
                'deductions' => 500.00,
                'pf_rate' => 12.00,
                'esic_rate' => 0.75,
                'cl_allowance' => 10,
                'el_allowance' => 15,
                'effective_from' => Carbon::now()->startOfYear(),
                'is_active' => true,
            ]);
        }

        // 3. Seed Mock Visitors
        Visitor::firstOrCreate(
            ['pass_number' => 'VIS-' . Carbon::today()->format('Ymd') . '-0001'],
            [
                'institute_id' => $instituteId,
                'visitor_name' => 'Rahul Mehra',
                'phone_number' => '9811223344',
                'email' => 'rahul@mehra.com',
                'purpose' => 'Admission Enquiry',
                'whom_to_meet_id' => $teacher ? $teacher->id : null,
                'gate_number' => 'Main Security Gate',
                'vehicle_number' => 'DL-3C-CK-1288',
                'id_proof_type' => 'Aadhaar Card',
                'id_proof_number' => '9827',
                'check_in_time' => Carbon::now()->subHours(3),
                'status' => 'checked_in',
                'remarks' => 'Carrying laptop bag.',
            ]
        );

        Visitor::firstOrCreate(
            ['pass_number' => 'VIS-' . Carbon::today()->format('Ymd') . '-0002'],
            [
                'institute_id' => $instituteId,
                'visitor_name' => 'Suresh Gupta',
                'phone_number' => '9988776655',
                'email' => 'suresh@gupta.com',
                'purpose' => 'Supplier / Delivery',
                'whom_to_meet_name' => 'Mess Kitchen Warden',
                'gate_number' => 'Hostel Gate A',
                'vehicle_number' => 'HR-26-Y-8833',
                'id_proof_type' => 'Driving License',
                'id_proof_number' => 'HR-1092-298',
                'check_in_time' => Carbon::now()->subHours(5),
                'check_out_time' => Carbon::now()->subHours(2),
                'status' => 'checked_out',
                'remarks' => 'Delivered inventory uniforms.',
            ]
        );

        Visitor::firstOrCreate(
            ['pass_number' => 'VIS-' . Carbon::today()->format('Ymd') . '-0003'],
            [
                'institute_id' => $instituteId,
                'visitor_name' => 'Sunita Deshmukh',
                'phone_number' => '9766554433',
                'purpose' => 'Parent-Teacher Meeting',
                'whom_to_meet_id' => $teacher ? $teacher->id : null,
                'gate_number' => 'Main Security Gate',
                'id_proof_type' => 'PAN Card',
                'check_in_time' => Carbon::now()->subMinutes(45),
                'status' => 'checked_in',
            ]
        );

        Visitor::firstOrCreate(
            ['pass_number' => 'VIS-' . Carbon::today()->format('Ymd') . '-0004'],
            [
                'institute_id' => $instituteId,
                'visitor_name' => 'Amit Sharma',
                'phone_number' => '9822334455',
                'email' => 'amit@sharma.com',
                'purpose' => 'Official Meeting',
                'whom_to_meet_id' => $teacher ? $teacher->id : null,
                'gate_number' => 'Main Gate',
                'vehicle_number' => 'DL-9C-AA-0922',
                'id_proof_type' => 'Driving License',
                'id_proof_number' => '4922',
                'check_in_time' => null,
                'status' => 'pending',
                'remarks' => 'Carrying catalog materials.',
            ]
        );
    }
}

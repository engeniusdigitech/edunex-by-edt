<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\TransportRoute;
use App\Models\TransportStop;
use App\Models\Driver;
use App\Models\Student;
use App\Models\StudentTransportAllocation;
use App\Models\AccountingLedger;
use App\Models\Expense;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class TransportAndAccountingSeeder extends Seeder
{
    public function run(): void
    {
        // Apex Institute ID is 1 (or we find the first one)
        $instituteId = \App\Models\Institute::first()->id ?? 1;

        // 1. Seed Vehicles
        $vehicle = Vehicle::firstOrCreate(
            ['vehicle_number' => 'DL-1PC-8822'],
            [
                'institute_id' => $instituteId,
                'vehicle_name' => 'Delhi Transit Bus #5',
                'capacity' => 40,
                'is_active' => true,
            ]
        );

        // 2. Seed Driver
        Driver::firstOrCreate(
            ['mobile_number' => '9818273645'],
            [
                'institute_id' => $instituteId,
                'driver_name' => 'Ramesh Kumar',
                'vehicle_id' => $vehicle->id,
            ]
        );

        // 3. Seed Route
        $route = TransportRoute::firstOrCreate(
            ['route_name' => 'Route 12 - Connaught Place Express'],
            [
                'institute_id' => $instituteId,
                'route_description' => 'Express route covering Connaught Place, Mandir Marg, Karol Bagh and Rajendra Place.',
                'fee' => 1200.00,
            ]
        );

        // 4. Seed Stops with Delhi coordinates
        $stop1 = TransportStop::firstOrCreate(
            [
                'transport_route_id' => $route->id,
                'stop_name' => 'Connaught Place Hub',
            ],
            [
                'institute_id' => $instituteId,
                'latitude' => 28.63040000,
                'longitude' => 77.21770000,
                'sort_order' => 1,
            ]
        );

        $stop2 = TransportStop::firstOrCreate(
            [
                'transport_route_id' => $route->id,
                'stop_name' => 'Mandir Marg Crossing',
            ],
            [
                'institute_id' => $instituteId,
                'latitude' => 28.63280000,
                'longitude' => 77.20240000,
                'sort_order' => 2,
            ]
        );

        $stop3 = TransportStop::firstOrCreate(
            [
                'transport_route_id' => $route->id,
                'stop_name' => 'Karol Bagh Metro Station',
            ],
            [
                'institute_id' => $instituteId,
                'latitude' => 28.64330000,
                'longitude' => 77.18880000,
                'sort_order' => 3,
            ]
        );

        $stop4 = TransportStop::firstOrCreate(
            [
                'transport_route_id' => $route->id,
                'stop_name' => 'Rajendra Place',
            ],
            [
                'institute_id' => $instituteId,
                'latitude' => 28.64180000,
                'longitude' => 77.17830000,
                'sort_order' => 4,
            ]
        );

        // 5. Allocate student Jane or Abid Saiyed (from DatabaseSeeder)
        $student = Student::where('email', 'student@edu.com')->first();
        if ($student) {
            StudentTransportAllocation::firstOrCreate(
                ['student_id' => $student->id],
                [
                    'institute_id' => $instituteId,
                    'transport_route_id' => $route->id,
                    'transport_stop_id' => $stop1->id,
                    'vehicle_id' => $vehicle->id,
                    'fee_status' => 'Paid',
                ]
            );
        }

        // 6. Seed Accounting default ledgers
        $cashLedger = AccountingController::getSystemLedger('Cash-in-Hand', 'asset', '1001');
        $bankLedger = AccountingController::getSystemLedger('Bank Account', 'asset', '1002');
        $receivableLedger = AccountingController::getSystemLedger('Tuition Fee Receivable', 'asset', '1003');
        $feeRevenueLedger = AccountingController::getSystemLedger('Tuition Fee Revenue', 'revenue', '3001');
        $gstPayableLedger = AccountingController::getSystemLedger('GST Collected (Liability)', 'liability', '2001');
        $gstInputLedger = AccountingController::getSystemLedger('GST Input tax (Asset)', 'asset', '1004');

        // Seed some custom expense categories
        $fuelLedger = AccountingLedger::firstOrCreate(
            ['name' => 'Vehicle Fuel Outlays'],
            [
                'institute_id' => $instituteId,
                'type' => 'expense',
                'code' => '5001',
                'is_system' => false,
            ]
        );

        $stationeryLedger = AccountingLedger::firstOrCreate(
            ['name' => 'Office Stationery Expenses'],
            [
                'institute_id' => $instituteId,
                'type' => 'expense',
                'code' => '5002',
                'is_system' => false,
            ]
        );

        $cateringLedger = AccountingLedger::firstOrCreate(
            ['name' => 'Catering & Kitchen Outflows'],
            [
                'institute_id' => $instituteId,
                'type' => 'expense',
                'code' => '5003',
                'is_system' => false,
            ]
        );

        // 7. Seed some sample expenses using the store logic or model creation directly
        // We will mock the request and trigger the controller store method, or create it directly!
        // To be safe, let's create the records directly or mock the transactions:
        
        // Expense 1: Stationery purchased via Cash (Exempt)
        $exp1 = Expense::firstOrCreate(
            ['reference_no' => 'BILL-1002'],
            [
                'institute_id' => $instituteId,
                'accounting_ledger_id' => $stationeryLedger->id,
                'expense_date' => Carbon::now()->subDays(5),
                'net_amount' => 1500.00,
                'gst_rate' => 0.00,
                'gst_type' => 'none',
                'gst_amount' => 0.00,
                'total_amount' => 1500.00,
                'payment_method' => 'Cash',
                'description' => 'Purchased markers, registers, and office notebooks.',
            ]
        );

        // Voucher 1
        $vch1 = \App\Models\AccountingVoucher::firstOrCreate(
            ['reference_id' => $exp1->id, 'reference_type' => Expense::class],
            [
                'institute_id' => $instituteId,
                'voucher_number' => 'EXP-VCH-001',
                'type' => 'payment',
                'date' => Carbon::now()->subDays(5),
                'narration' => 'Purchased markers, registers, and office notebooks.',
                'amount' => 1500.00,
            ]
        );
        \App\Models\AccountingJournalEntry::firstOrCreate(
            ['accounting_voucher_id' => $vch1->id, 'accounting_ledger_id' => $stationeryLedger->id],
            ['entry_type' => 'debit', 'amount' => 1500.00]
        );
        \App\Models\AccountingJournalEntry::firstOrCreate(
            ['accounting_voucher_id' => $vch1->id, 'accounting_ledger_id' => $cashLedger->id],
            ['entry_type' => 'credit', 'amount' => 1500.00]
        );

        // Expense 2: Vehicle Fuel purchased via Bank (18% GST CGST/SGST)
        $exp2 = Expense::firstOrCreate(
            ['reference_no' => 'FUEL-8902'],
            [
                'institute_id' => $instituteId,
                'accounting_ledger_id' => $fuelLedger->id,
                'expense_date' => Carbon::now()->subDays(2),
                'net_amount' => 8000.00,
                'gst_rate' => 18.00,
                'gst_type' => 'cgst_sgst',
                'gst_amount' => 1440.00,
                'total_amount' => 9440.00,
                'payment_method' => 'Bank',
                'description' => 'Weekly fuel filling for Delhi Transit Bus #5.',
            ]
        );

        // Voucher 2
        $vch2 = \App\Models\AccountingVoucher::firstOrCreate(
            ['reference_id' => $exp2->id, 'reference_type' => Expense::class],
            [
                'institute_id' => $instituteId,
                'voucher_number' => 'EXP-VCH-002',
                'type' => 'payment',
                'date' => Carbon::now()->subDays(2),
                'narration' => 'Weekly fuel filling for Delhi Transit Bus #5.',
                'amount' => 9440.00,
            ]
        );
        \App\Models\AccountingJournalEntry::firstOrCreate(
            ['accounting_voucher_id' => $vch2->id, 'accounting_ledger_id' => $fuelLedger->id],
            ['entry_type' => 'debit', 'amount' => 8000.00]
        );
        \App\Models\AccountingJournalEntry::firstOrCreate(
            ['accounting_voucher_id' => $vch2->id, 'accounting_ledger_id' => $gstInputLedger->id],
            ['entry_type' => 'debit', 'amount' => 1440.00]
        );
        \App\Models\AccountingJournalEntry::firstOrCreate(
            ['accounting_voucher_id' => $vch2->id, 'accounting_ledger_id' => $bankLedger->id],
            ['entry_type' => 'credit', 'amount' => 9440.00]
        );
    }
}

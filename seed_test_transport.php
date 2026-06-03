<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$student = App\Models\Student::first();
if ($student) {
    $instId = $student->institute_id;
    $batchId = $student->batch_id;

    // Create Vehicle
    $v = App\Models\Vehicle::firstOrCreate(
        ['vehicle_number' => 'MH-12-GQ-4321'],
        [
            'institute_id' => $instId,
            'vehicle_name' => 'Apex School Bus 04',
            'capacity' => 40,
            'is_active' => true,
        ]
    );

    // Create Driver
    $d = App\Models\Driver::firstOrCreate(
        ['mobile_number' => '9876501234'],
        [
            'institute_id' => $instId,
            'driver_name' => 'Rajesh Kumar',
            'vehicle_id' => $v->id,
        ]
    );

    // Create Route
    $r = App\Models\TransportRoute::firstOrCreate(
        ['route_name' => 'Route A - Kothrud to Apex'],
        [
            'institute_id' => $instId,
            'route_description' => 'Morning and evening pickup/drop via Karve Road.',
            'fee' => 1500.00,
        ]
    );

    // Create Stop
    $s = App\Models\TransportStop::firstOrCreate(
        ['stop_name' => 'Kothrud Depot Bus Stop'],
        [
            'institute_id' => $instId,
            'transport_route_id' => $r->id,
        ]
    );

    // Create Student Transport Allocation
    $a = App\Models\StudentTransportAllocation::firstOrCreate(
        ['student_id' => $student->id],
        [
            'institute_id' => $instId,
            'transport_route_id' => $r->id,
            'transport_stop_id' => $s->id,
            'vehicle_id' => $v->id,
            'fee_status' => 'Paid',
        ]
    );

    // Seed class chat room messages
    $t = App\Models\User::where('email', 'teacher@apexinstitute.com')->first();
    if ($t) {
        App\Models\ClassChatMessage::firstOrCreate(
            [
                'batch_id' => $batchId,
                'sender_id' => $t->id,
                'sender_type' => get_class($t),
                'message' => 'Hello everyone! Please remember to bring your chemistry lab notebooks tomorrow.'
            ],
            ['institute_id' => $instId]
        );
        App\Models\ClassChatMessage::firstOrCreate(
            [
                'batch_id' => $batchId,
                'sender_id' => $student->id,
                'sender_type' => get_class($student),
                'message' => 'Yes ma\'am, I have completed the exercise.'
            ],
            ['institute_id' => $instId]
        );
    }
    echo "Seed completed successfully!\n";
} else {
    echo "No student found.\n";
}

<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;

    protected int $instituteId;

    public function __construct(int $instituteId)
    {
        $this->instituteId = $instituteId;
    }

    public function model(array $row): ?Student
    {
        // Resolve batch — accept either an ID or a batch name
        $batchId = null;
        if (!empty($row['batch_id'])) {
            if (is_numeric($row['batch_id'])) {
                $batchId = (int) $row['batch_id'];
            } else {
                $batch = Batch::where('name', $row['batch_id'])
                    ->where('institute_id', $this->instituteId)
                    ->first();
                $batchId = $batch?->id;
            }
        }

        if (!$batchId) {
            return null; // skip rows without a valid batch
        }

        $password = !empty($row['password']) ? $row['password'] : ($row['phone'] ?? 'Pass@1234');

        return new Student([
            'institute_id'       => $this->instituteId,
            'batch_id'           => $batchId,
            'name'               => $row['name'],
            'email'              => $row['email'] ?? null,
            'phone'              => $row['phone'] ?? '',
            'roll_number'        => $row['roll_number'] ?? null,
            'gender'             => $row['gender'] ?? null,
            'blood_group'        => $row['blood_group'] ?? null,
            'father_name'        => $row['father_name'] ?? null,
            'mother_name'        => $row['mother_name'] ?? null,
            'parent_email'       => $row['parent_email'] ?? null,
            'alternate_phone_1'  => $row['alternate_phone_1'] ?? null,
            'enrollment_date'    => !empty($row['enrollment_date']) ? $row['enrollment_date'] : now()->toDateString(),
            'password'           => Hash::make($password),
            'is_active'          => 1,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ];
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}

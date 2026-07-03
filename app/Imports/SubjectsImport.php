<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SubjectsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;

    protected int $instituteId;

    public function __construct(int $instituteId)
    {
        $this->instituteId = $instituteId;
    }

    public function model(array $row): ?Subject
    {
        // Resolve batch by name or ID
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
            return null;
        }

        return new Subject([
            'institute_id' => $this->instituteId,
            'batch_id'     => $batchId,
            'name'         => $row['name'],
            'is_active'    => isset($row['is_active']) ? (bool) $row['is_active'] : true,
        ]);
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'batch_id' => 'required',
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

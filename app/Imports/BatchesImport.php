<?php

namespace App\Imports;

use App\Models\Batch;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BatchesImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;

    protected int $instituteId;

    public function __construct(int $instituteId)
    {
        $this->instituteId = $instituteId;
    }

    public function model(array $row): Batch
    {
        return new Batch([
            'institute_id' => $this->instituteId,
            'name'         => $row['name'],
            'is_active'    => isset($row['is_active']) ? (bool) $row['is_active'] : true,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
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

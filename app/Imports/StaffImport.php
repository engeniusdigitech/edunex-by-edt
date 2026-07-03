<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StaffImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;

    protected int $instituteId;

    public function __construct(int $instituteId)
    {
        $this->instituteId = $instituteId;
    }

    public function model(array $row): ?User
    {
        // Resolve role — accept role_name (e.g. "Teacher") or role_id
        $roleId = null;
        if (!empty($row['role_id']) && is_numeric($row['role_id'])) {
            $roleId = (int) $row['role_id'];
        } elseif (!empty($row['role_name'])) {
            $role = Role::where('name', $row['role_name'])->first();
            $roleId = $role?->id;
        }

        if (!$roleId) {
            return null;
        }

        // Skip if email already exists
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        $password = !empty($row['password']) ? $row['password'] : 'Pass@1234';

        return new User([
            'institute_id' => $this->instituteId,
            'role_id'      => $roleId,
            'name'         => $row['name'],
            'email'        => $row['email'],
            'password'     => Hash::make($password),
        ]);
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
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

<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithUpserts, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        $user = User::updateOrCreate(
            [
                'email' => $row['email'],
            ],
            [
                'username'   => str()->slug($row['username'], ''),
                'first_name' => $row['first_name'],
                'last_name'  => $row['last_name'],
                'full_name'  => $row['full_name'],
                'phone'      => $row['phone'],
                'email'      => $row['email'],
                'password'   => Hash::make($row['password']),
                'status'     => $row['status'],
                'created_by' => auth()->user()->id,
            ]
        );

        $user->syncRoles($row['role']);
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function uniqueBy()
    {
        return 'email';
    }

    public function rules(): array
    {
        return [
            'username' => [
                'required', 'string', 'min:4', 'max:30',
                Rule::notIn(['superadmin', 'admin', 'member'])
            ],
            'first_name' => [
                'required', 'string', 'min:2', 'max:191'
            ],
            'full_name' => [
                'required', 'string', 'min:2', 'max:191'
            ],
            'phone' => [
                'string', 'min:10', 'max:13'
            ],
            'email' => [
                'required', 'string', 'email',
                Rule::notIn(['superadmin@mail.com', 'admin@mail.com', 'member@mail.com', 'susantokun.com@gmail.com'])
            ],
            'password' => [
                'required', 'string', 'min:8', 'max:30',
            ],
            'status' => [
                'required', 'string',
                Rule::in(['active', 'nonactive', 'suspend', 'banned'])
            ],
            'role' => [
                'required', 'string',
                Rule::in(['member', 'admin'])
            ],
        ];
    }
}

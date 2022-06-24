<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Support\Responsable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements Responsable, FromQuery, WithHeadings, WithMapping, WithStyles, WithEvents
{
    use Exportable;

    private $fileName = 'users.xlsx';
    private $writerType = Excel::XLSX;
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function query()
    {
        return User::query();
    }

    public function headings(): array
    {
        return [
            '#',
            __('user.username'),
            __('user.first_name'),
            __('user.last_name'),
            __('user.full_name'),
            __('user.phone'),
            __('user.email'),
            __('user.status'),
            __('user.last_login_at'),
            __('user.last_login_ip'),
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->username,
            $user->first_name,
            $user->last_name,
            $user->full_name,
            $user->phone,
            $user->email,
            $user->status,
            $user->last_login_at,
            $user->last_login_ip,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(6);
                $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(16);
            },
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Email', 'Role'];
    }

    public function map($user): array
    {
        return[
            $user->id,
            $user->name,
            $user->email,
            $user->role,
        ];
    }
}

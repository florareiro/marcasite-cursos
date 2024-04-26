<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Excel;


class UsersExport
{



    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Created at',
            'Curso'
        ];
    }
}

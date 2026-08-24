<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings,WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select("name", "email", "primaryPhone",'created_at')->get();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone Number',
            'Created Date'
        ];
    }
    
    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->primaryPhone,
            date('Y-m-d h:i A',strtotime($user->created_at))
            
        ];
    }
}

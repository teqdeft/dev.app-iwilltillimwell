<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersErrorExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;

    function __construct($data){
        $this->data = $data;
    }

    public function collection()
    {   
        return collect($this->data);
    }
    public function headings(): array
    {
        return [
            'First & Last Name',
            'Student or Staff Member',
            'Date of Birth',
            'Gender',
            'Email',
            'Primary Phone#',
            'Home Address',
            'School Address (if different from home)',
            'City',
            'State',
            'Zip code',
            'Time zone',
            'Year in School:',
            'Error',
        ];
    }
}

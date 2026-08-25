<?php

namespace Modules\ImwellApp\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

/**
 * The "Download xlsx format" sample sheet for member imports.
 */
class MemberSampleExport implements FromArray
{
    protected $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    public function array(): array
    {
        return $this->rows;
    }
}

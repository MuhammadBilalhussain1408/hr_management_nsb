<?php

namespace App\Exports;

use App\Models\RightWork;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class RightWorkExport implements FromCollection
{
    protected $data;
    protected $employee;
    protected $org;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return RightWork::where('id', $this->data)->get();
    }
}

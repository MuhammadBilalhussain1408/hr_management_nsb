<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $employee;
    protected $org;

   // public $employee;
    public function __construct($employee)
    {
        $this->employee = $employee;
    }
    public function collection()
    {
        return Employee::where('id', $this->employee)->get();
    }
 
}

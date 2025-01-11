<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LeaveAllocation;
use Auth;

class LeaveReportExport implements FromCollection
{
    protected $year;
    protected $org;
    
    public function __construct($year, $org)
    {
        $this->year = $year;
        $this->org = $org;
    }
    public function collection()
    {
        return LeaveAllocation::whereYear('effect_year', $this->year)->where('organization_id', Auth::user()->org->id)->get();
    }

}

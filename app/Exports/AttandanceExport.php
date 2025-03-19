<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttandanceExport implements FromCollection, WithHeadings
{
    protected $from;
    protected $to;
    protected $emp_id;

    // public $employee;
    public function __construct($from, $to, $emp_id)
    {
        $this->from = $from;
        $this->to = $to;
        $this->emp_id = $emp_id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Load users with their posts
        return Attendance::select('employee_id', 'checked_in', 'date', 'checked_out', 'designation_id', 'department_id', 'status','duration')
            ->with(['emp', 'designation', 'department'])  // Ensure you load the related models
            ->when($this->from && $this->to, function ($query) {
                return $query->whereBetween('created_at', [$this->from, $this->to]);
            })
            ->when($this->emp_id, function ($query) {
                return $query->where('employee_id', $this->emp_id);
            })
            ->get()
            ->map(function ($att) {
                return [
                    'employee' => $att->emp ? $att->emp->fname . ' ' . $att->emp->lname : null, // Ensure emp exists
                    'date' => $att->date,  // Correct field name: 'date' is fine
                    'checked_in' => $att->checked_in,
                    'checked_out' => $att->checked_out,
                    'attendance_status' => $att->attendance_status,
                    'designation' => $att->designation ? $att->designation->name : null,  // Ensure designation exists
                    'department' => $att->department ? $att->department->name : null,  // Ensure department exists
                    'duration' => $att->duration,  // Ensure department exists
                ];
            });
    }
    public function headings(): array
    {
        return [
            'Employee Name',        // Custom heading for 'name'
            'Date',    // Custom heading for 'email'
            'Checked Inn',  // Custom heading for 'created_at'
            'Checked Out',       // Custom heading for 'post_title'
            'Status',       // Custom heading for 'post_title'
            'Designation',       // Custom heading for 'post_title'
            'Department',       // Custom heading for 'post_title'
            'Duration',       // Custom heading for 'post_title'
        ];
    }
}

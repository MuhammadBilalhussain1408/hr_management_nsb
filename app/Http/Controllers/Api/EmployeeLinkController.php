<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeLinkController extends Controller
{
    public function create()
    {
        return view('hrm.employees.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'department' => 'required',
            'user_id' => 'required',
        ]);
    
        Employee::create($request->all());
    
        return redirect()->route('hrm.employees.index')
                        ->with('success','employee created successfully.');
    }
}

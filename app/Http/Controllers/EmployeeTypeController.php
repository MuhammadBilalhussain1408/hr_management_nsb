<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use App\Models\Organization;
use Illuminate\Http\Request;
use Auth;

class EmployeeTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-type-list|employee-type-create|employee-type-edit|employee-type-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:employee-type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employee-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employee-type-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = EmployeeType::latest()->paginate('20');
        } else {
            $datas = EmployeeType::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.employee_types.index', compact('datas'));
    }
    public function create()
    {
        return view('hrm.employee_types.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'organization_id' => 'required'
        ]);

        EmployeeType::create($request->all());

        return redirect()->route('hrm.employee_types.index')
            ->with('success', 'employee-type created successfully.');
    }
    public function show(EmployeeType $data)
    {
        return view('hrm.employee_types.show', compact('data'));
    }
    public function edit(EmployeeType $employee_type)
    {
        return view('hrm.employee_types.edit', compact('employee_type'));
    }
    public function update(Request $request, EmployeeType $employee_type)
    {
      //  return $request;
        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'organization_id' => 'required',
        ]);

         $employee_type->update($request->all());

        return redirect()->route('hrm.employee_types.index')
            ->with('success', 'employee-type updated successfully');
    }
    public function destroy(EmployeeType $data)
    {
        $data->delete();

        return redirect()->route('hrm.employee_types.index')
            ->with('success', 'employee-type deleted successfully');
    }
  
}

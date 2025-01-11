<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Auth;

class DepartmentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:department-list|department-create|department-edit|department-delete', ['only' => ['index','show']]);
         $this->middleware('permission:department-create', ['only' => ['create','store']]);
         $this->middleware('permission:department-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $org = Auth::user()->org->id;
        $departments = Department::where('organization_id',$org)->latest()->paginate('20');
        return view('hrm.departments.index',compact('departments'));
    }
    public function create()
    {
        // return $user = Auth::user()->org->id;
        return view('hrm.departments.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        Department::create($request->all());
    
        return redirect()->route('hrm.departments.index')
                        ->with('success','department created successfully.');
    }
    public function show(department $department)
    {
        return view('hrm.departments.show',compact('department'));
    }
    public function edit(department $department)
    {
        return view('hrm.departments.edit',compact('department'));
    }
    public function update(Request $request, department $department)
    {
         request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        $department->update($request->all());
    
        return redirect()->route('hrm.departments.index')
                        ->with('success','department updated successfully');
    }
    public function destroy(department $department)
    {
        $department->delete();
    
        return redirect()->route('hrm.departments.index')
                        ->with('success','department deleted successfully');
    }
}

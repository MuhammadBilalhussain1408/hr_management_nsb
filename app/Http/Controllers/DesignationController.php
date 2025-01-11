<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Department;
use Illuminate\Http\Request;
use Auth;

class DesignationController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:designation-list|designation-create|designation-edit|designation-delete', ['only' => ['index','show']]);
         $this->middleware('permission:designation-create', ['only' => ['create','store']]);
         $this->middleware('permission:designation-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:designation-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $org = Auth::user()->org->id;
        $designations = Designation::where('organization_id',$org)->latest()->paginate('20');
        return view('hrm.designations.index',compact('designations'));
    }
    public function create()
    {
        $org = Auth::user()->org->id;
        $departments = Department::where('organization_id',$org)->where('status','Enable')->get();
        return view('hrm.designations.create',compact('departments'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
            'department_id' => 'required',
        ]);
    
        Designation::create($request->all());
    
        return redirect()->route('hrm.designations.index')
                        ->with('success','designation created successfully.');
    }
    public function show(designation $designation)
    {
        return view('hrm.designations.show',compact('designation'));
    }
    public function edit(designation $designation)
    {
        $org = Auth::user()->org->id;
        $departments = Department::where('organization_id',$org)->where('status','Enable')->get();
        return view('hrm.designations.edit',compact('designation','departments'));
    }
    public function update(Request $request, Designation $designation)
    {
         request()->validate([
            'name' => 'required',
            'status' => 'required',
            'department_id' => 'required',
        ]);
    
        $designation->update($request->all());
    
        return redirect()->route('hrm.designations.index')
                        ->with('success','designation updated successfully');
    }
    public function destroy(designation $designation)
    {
        $designation->delete();
    
        return redirect()->route('hrm.designations.index')
                        ->with('success','designation deleted successfully');
    }
}

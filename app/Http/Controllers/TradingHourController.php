<?php

namespace App\Http\Controllers;

use App\Models\Trading_hour;
use Illuminate\Http\Request;

class TradingHourController extends Controller
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
        $designations = Designation::latest()->paginate('20');
        return view('hrm.designations.index',compact('designations'));
    }
    public function create()
    {
        return view('hrm.designations.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
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
        return view('hrm.designations.edit',compact('designation'));
    }
    public function update(Request $request, designation $designation)
    {
         request()->validate([
            'name' => 'required',
            'status' => 'required',
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

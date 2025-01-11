<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\Organization;
use Illuminate\Http\Request;
use Auth;
use Str;

class LeaveTypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:leaveType-list|leaveType-create|leaveType-edit|leaveType-delete', ['only' => ['index','show']]);
         $this->middleware('permission:leaveType-create', ['only' => ['create','store']]);
         $this->middleware('permission:leaveType-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:leaveType-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $leave_types = leaveType::latest()->paginate('20');
        } else {
            $leave_types = leaveType::latest()->where('organization_id', $org)->paginate('20');
        }
       
        return view('hrm.leave_types.index',compact('leave_types'));
    }
    public function create()
    {
        $organizations = Organization::get();
        return view('hrm.leave_types.create',compact('organizations'));
    }
    public function store(Request $request)
    {
        $request['slug'] = $request->organization_id.Str::random(8);
        request()->validate([
            'name' => 'required',
            'organization_id' => 'required',
        ]);
       
        leaveType::create($request->all());

        return redirect()->route('hrm.leave_types.index')
                        ->with('success','holiday_type created successfully.');
    }

    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // $organizations = Organization::get();
        $leaveType = leaveType::where('slug',$id)->first();
        return view('hrm.leave_types.edit',compact('leaveType'));
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        request()->validate([
            'name' => 'required',
            'organization_id' => 'required',
        ]);
        $leaveType->update($request->all());

        return redirect()->route('hrm.leave_types.index')
            ->with('success', 'leaveType updated successfully');
    }

 
    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        return redirect()->route('hrm.leave_types.index')
            ->with('success', 'leaveType deleted successfully');
    }
}

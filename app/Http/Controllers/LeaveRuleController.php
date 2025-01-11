<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use App\Models\LeaveRule;
use App\Models\LeaveType;
use App\Models\Organization;
use Illuminate\Http\Request;
use Auth;
use Str;

class LeaveRuleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:LeaveRule-list|LeaveRule-create|LeaveRule-edit|LeaveRule-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:LeaveRule-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:LeaveRule-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:LeaveRule-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $leaveRules = LeaveRule::paginate('20');
        } else {
            $leaveRules = LeaveRule::where('organization_id', $org)->paginate('20');
        }

        return view('hrm.leave_rules.index', compact('leaveRules'));
    }
    public function create()
    {
        $org =  Auth::user()->org->id;
        $etypes = EmployeeType::where('organization_id', $org)->get();
        $leave_types = LeaveType::where('organization_id', $org)->get();
        return view('hrm.leave_rules.create', compact('leave_types','etypes'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $request['slug'] = $request->organization_id . Str::random(8);
        request()->validate([
            'effect_from' => 'required',
            'effect_to' => 'required',
            'leave_type_id' => 'required',
            'organization_id' => 'required',
        ]);


        LeaveRule::create($request->all());

        return redirect()->route('hrm.leave_rules.index')
            ->with('success', 'LeaveRule created successfully.');
    }
    public function show(LeaveRule $leaveRule)
    {
        //
    }

    public function edit($id)
    {
        $leaveRule = LeaveRule::where('slug', $id)->first();
        $org =  Auth::user()->org->id;
        $etypes = EmployeeType::where('organization_id', $org)->get();
        $leave_types = LeaveType::where('organization_id', $org)->get();
        return view('hrm.leave_rules.edit', compact('leaveRule', 'etypes','leave_types'));
    }

 
    public function update(Request $request, LeaveRule $leaveRule)
    {
        request()->validate([
            'effect_from' => 'required',
            'effect_to' => 'required',
            'leave_type_id' => 'required',
            'organization_id' => 'required',
        ]);
        //   $request['slug'] = Str::random(8);
        $leaveRule->update($request->all());

        return redirect()->route('hrm.leave_rules.index')
            ->with('success', 'LeaveRule updated successfully');
    }

    public function destroy(LeaveRule $leaveRule)
    {
        $leaveRule->delete();

        return redirect()->route('hrm.leave_rules.index')
            ->with('success', 'leaveRule deleted successfully');
    }
}

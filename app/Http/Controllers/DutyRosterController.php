<?php

namespace App\Http\Controllers;

use App\Models\DutyRoster;
use App\Models\Department;
use Auth;
use SoftDeletes;
use Illuminate\Http\Request;

class DutyRosterController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:duty-roster-list|duty-roster-create|duty-roster-edit|duty-roster-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:duty-roster-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:duty-roster-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:duty-roster-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
           $datas = DutyRoster::withTrashed()->paginate('20');
        } else {
           $datas = DutyRoster::where('organization_id', $org)->withTrashed()->paginate('20');
        }

        return view('hrm.duty_rosters.index', compact('datas'));
    }
    public function create(Request $request)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }


        return view('hrm.duty_rosters.create', compact('departments'));
    }
    public function store(Request $request)
    {
        // dd($request);
        //   $request['slug'] = $request->organization_id . Str::random(8);
        request()->validate([
            'organization_id' => 'required',
            'department_id' => 'required',
            'employee_id' => 'required',
        ]);

        DutyRoster::create($request->all());

        return redirect()->route('hrm.duty_rosters.index')
            ->with('success', 'DutyRoster created successfully.');
    }
    public function show(DutyRoster $DutyRoster)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $dutyRoster = DutyRoster::where('id', $id)->first();
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
       if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }
        return view('hrm.duty_rosters.edit', compact('dutyRoster', 'departments'));
    }
    public function update(Request $request, DutyRoster $dutyRoster)
    {
        request()->validate([
            'organization_id' => 'required',
            'department_id' => 'required',
            'employee_id' => 'required',
        ]);
       
        $dutyRoster->update($request->all());

        return redirect()->route('hrm.duty_rosters.index')
            ->with('success', 'DutyRoster updated successfully');
    }

    public function destroy(DutyRoster $dutyRoster)
    {
        $user = Auth::user('id', 'name');
        $request['deleted_by'] = $user->id;
        $dutyRoster->delete();
       
       // $DutyRoster->deleted_at = $user->id;
      //  $DutyRoster->save();

        return redirect()->route('hrm.duty_rosters.index')
            ->with('success', 'DutyRoster deleted successfully');
    }
}

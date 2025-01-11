<?php

namespace App\Http\Controllers;

use App\Models\GracePeriod;
use App\Models\Department;
use Auth;
use SoftDeletes;
use Illuminate\Http\Request;

class GracePeriodController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:grace-period-list|grace-period-create|grace-period-edit|grace-period-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:grace-period-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:grace-period-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:grace-period-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
           $datas = GracePeriod::withTrashed()->paginate('20');
        } else {
           $datas = GracePeriod::where('organization_id', $org)->withTrashed()->paginate('20');
        }

        return view('hrm.grace_periods.index', compact('datas'));
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


        return view('hrm.grace_periods.create', compact('departments'));
    }
    public function store(Request $request)
    {
        // dd($request);
        //   $request['slug'] = $request->organization_id . Str::random(8);
        request()->validate([
            'organization_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);

        GracePeriod::create($request->all());

        return redirect()->route('hrm.grace_periods.index')
            ->with('success', 'Graceperiod created successfully.');
    }
    public function show(Graceperiod $Graceperiod)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $graceperiod = GracePeriod::where('id', $id)->first();
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
       if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }
        return view('hrm.grace_periods.edit', compact('graceperiod', 'departments'));
    }
    public function update(Request $request, Graceperiod $graceperiod)
    {
        request()->validate([
            'organization_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
       
        $graceperiod->update($request->all());

        return redirect()->route('hrm.grace_periods.index')
            ->with('success', 'Graceperiod updated successfully');
    }

    public function destroy(Graceperiod $graceperiod)
    {
        $user = Auth::user('id', 'name');
        $request['deleted_by'] = $user->id;
        $graceperiod->delete();
       
       // $DutyRoster->deleted_at = $user->id;
      //  $DutyRoster->save();

        return redirect()->route('hrm.grace_periods.index')
            ->with('success', 'DutyRoster deleted successfully');
    }
}

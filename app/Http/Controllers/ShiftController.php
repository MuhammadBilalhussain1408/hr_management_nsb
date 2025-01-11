<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Department;
use Auth;
use Illuminate\Http\Request;
use SoftDeletes;


class ShiftController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:shift-list|shift-create|shift-edit|shift-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:shift-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:shift-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:shift-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole =='Admin')) {
            $shifts = Shift::where('deleted_at',null)->paginate('20');
        } else {
            $shifts = Shift::where('organization_id', $org)->where('deleted_at',null)->paginate('20');
        }

        return view('hrm.shifts.index', compact('shifts'));
    }
    public function create(Request $request)
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole =='Admin')) {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }


        return view('hrm.shifts.create', compact('departments'));
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

        Shift::create($request->all());

        return redirect()->route('hrm.shifts.index')
            ->with('success', 'Shift created successfully.');
    }
    public function show(Shift $Shift)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $shift = Shift::where('id', $id)->first();
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
       if (($userRole == 'Supper Admin') || ($userRole =='Admin')) {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }
        return view('hrm.shifts.edit', compact('shift', 'departments'));
    }

    public function update(Request $request, Shift $shift)
    {
        request()->validate([
            'organization_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
        //   $request['slug'] = Str::random(8);
        $shift->update($request->all());

        return redirect()->route('hrm.shifts.index')
            ->with('success', 'Shift updated successfully');
    }

  
    public function destroy(Shift $shift)
    {
        $user = Auth::user('id', 'name');
        $request['deleted_by'] = $user->id;
        $shift->delete();
       
       // $shift->deleted_at = $user->id;
      //  $shift->save();

        return redirect()->route('hrm.shifts.index')
            ->with('success', 'Shift deleted successfully');
    }
    public function shift_code(Request $request, $empid, $des_id)
    {
        $job_empid = Shift::where([['designation_id',$empid],['department_id',$des_id]])->select('id','shift_code')->get();
        echo json_encode($job_empid);  
    }
}

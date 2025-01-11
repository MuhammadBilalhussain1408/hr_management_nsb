<?php

namespace App\Http\Controllers;

use App\Models\DayOff;
use App\Models\Department;
use Auth;
use SoftDeletes;
use Illuminate\Http\Request;

class DayOffController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dayoff-list|dayoff-create|dayoff-edit|dayoff-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:dayoff-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dayoff-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dayoff-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
           $datas = DayOff::withTrashed()->paginate('20');
        } else {
           $datas = DayOff::where('organization_id', $org)->withTrashed()->paginate('20');
        }

        return view('hrm.dayoffs.index', compact('datas'));
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


        return view('hrm.dayoffs.create', compact('departments'));
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

        DayOff::create($request->all());

        return redirect()->route('hrm.dayoffs.index')
            ->with('success', 'DayOff created successfully.');
    }
    public function show(DayOff $DayOff)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $dayOff = DayOff::where('id', $id)->first();
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
       if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }
        return view('hrm.dayoffs.edit', compact('dayOff', 'departments'));
    }
    public function update(Request $request, DayOff $dayOff)
    {
       // dd($request);
        request()->validate([
            'organization_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
       
        $dayOff->update($request->all());

        return redirect()->route('hrm.dayoffs.index')
            ->with('success', 'DayOff updated successfully');
    }

  
    public function destroy(DayOff $dayOff)
    {
        $user = Auth::user('id', 'name');
        $request['deleted_by'] = $user->id;
        $dayOff->delete();
       
       // $DayOff->deleted_at = $user->id;
      //  $DayOff->save();

        return redirect()->route('hrm.dayoffs.index')
            ->with('success', 'DayOff deleted successfully');
    }
}

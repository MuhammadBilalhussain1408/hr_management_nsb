<?php

namespace App\Http\Controllers;

use App\Models\LatePolicy;
use App\Models\Department;
use Auth;
use SoftDeletes;
use Illuminate\Http\Request;


class LatePolicyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:late-policy-list|late-policy-create|late-policy-edit|late-policy-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:late-policy-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:late-policy-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:late-policy-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
           $datas = latePolicy::withTrashed()->paginate('20');
        } else {
           $datas = latePolicy::where('organization_id', $org)->withTrashed()->paginate('20');
        }

        return view('hrm.late-policy.index', compact('datas'));
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


        return view('hrm.late-policy.create', compact('departments'));
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

        latePolicy::create($request->all());

        return redirect()->route('hrm.late_policies.index')
            ->with('success', 'latePolicy created successfully.');
    }
    public function show(latePolicy $latePolicy)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $latePolicy = LatePolicy::where('id', $id)->first();
        $user = Auth::user('id', 'name');
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
       if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        } else {
            $departments = Department::where('organization_id', $org)->select('id', 'name', 'status')->get();
        }
        return view('hrm.late-policy.edit', compact('latePolicy', 'departments'));
    }
    public function update(Request $request, LatePolicy $latePolicy)
    {
        request()->validate([
            'organization_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ]);
       
        $latePolicy->update($request->all());

        return redirect()->route('hrm.late_policies.index')
            ->with('success', 'latePolicy updated successfully');
    }

 
    public function destroy(LatePolicy $latePolicy)
    {
        $user = Auth::user('id', 'name');
        $request['deleted_by'] = $user->id;
        $latePolicy->delete();
       
       // $latePolicy->deleted_at = $user->id;
      //  $latePolicy->save();

        return redirect()->route('hrm.late_policies.index')
            ->with('success', 'latePolicy deleted successfully');
    }
}

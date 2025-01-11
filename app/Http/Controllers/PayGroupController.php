<?php

namespace App\Http\Controllers;

use App\Models\PayGroup;
use Illuminate\Http\Request;
use Auth;

class PayGroupController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:paygroup-list|paygroup-create|paygroup-edit|paygroup-delete', ['only' => ['index','show']]);
         $this->middleware('permission:paygroup-create', ['only' => ['create','store']]);
         $this->middleware('permission:paygroup-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:paygroup-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $paygroups = PayGroup::latest()->paginate('20');
        } else {
            $paygroups = PayGroup::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.paygroups.index',compact('paygroups'));
    }
    public function create()
    {
        return view('hrm.paygroups.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        PayGroup::create($request->all());
    
        return redirect()->route('hrm.paygroups.index')
                        ->with('success','paygroup created successfully.');
    }
    public function show(PayGroup $paygroup)
    {
        return view('hrm.paygroups.show',compact('paygroup'));
    }
    public function edit(PayGroup $paygroup)
    {
        return view('hrm.paygroups.edit',compact('paygroup'));
    }
    public function update(Request $request, PayGroup $paygroup)
    {
         request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        $paygroup->update($request->all());
    
        return redirect()->route('hrm.paygroups.index')
                        ->with('success','paygroup updated successfully');
    }
    public function destroy(PayGroup $paygroup)
    {
        $paygroup->delete();
    
        return redirect()->route('hrm.paygroups.index')
                        ->with('success','paygroup deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Auth;

class TaxController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tax-list|tax-create|tax-edit|tax-delete', ['only' => ['index','show']]);
         $this->middleware('permission:tax-create', ['only' => ['create','store']]);
         $this->middleware('permission:tax-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tax-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $taxes = Tax::latest()->paginate('20');
        } else {
            $taxes = Tax::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.taxes.index',compact('taxes'));
    }
    public function create()
    {
        return view('hrm.taxes.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'tax_code' => 'required',
            'percentage_dis' => 'required',
        ]);
    
        Tax::create($request->all());
    
        return redirect()->route('hrm.taxes.index')
                        ->with('success','tax created successfully.');
    }
    public function show(tax $tax)
    {
        return view('hrm.taxes.show',compact('tax'));
    }
    public function edit(Tax $tax)
    {
        return view('hrm.taxes.edit',compact('tax'));
    }
    public function update(Request $request, Tax $tax)
    {
         request()->validate([
            'tax_code' => 'required',
            'percentage_dis' => 'required',
        ]);
    
        $tax->update($request->all());
    
        return redirect()->route('hrm.taxes.index')
                        ->with('success','tax updated successfully');
    }
    public function destroy(Tax $tax)
    {
        $tax->delete();
    
        return redirect()->route('hrm.taxes.index')
                        ->with('success','tax deleted successfully');
    }
}

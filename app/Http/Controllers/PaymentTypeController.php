<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use Auth;

class PaymentTypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:PaymentType-list|PaymentType-create|PaymentType-edit|PaymentType-delete', ['only' => ['index','show']]);
         $this->middleware('permission:PaymentType-create', ['only' => ['create','store']]);
         $this->middleware('permission:PaymentType-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:PaymentType-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $payment_types = PaymentType::latest()->paginate('20');
        } else {
            $payment_types = PaymentType::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.payment_types.index',compact('payment_types'));
    }
    public function create()
    {
        return view('hrm.payment_types.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'payment_type' => 'required',
            'working_hr' => 'required',
            'rate' => 'required',
        ]);
    
        PaymentType::create($request->all());
    
        return redirect()->route('hrm.payment_types.index')
                        ->with('success','PaymentType created successfully.');
    }
    public function show(PaymentType $PaymentType)
    {
        return view('hrm.payment_types.show',compact('PaymentType'));
    }
    public function edit(PaymentType $PaymentType)
    {
        return view('hrm.payment_types.edit',compact('PaymentType'));
    }
    public function update(Request $request, PaymentType $PaymentType)
    {
         request()->validate([
            'payment_type' => 'required',
            'working_hr' => 'required',
            'rate' => 'required',
        ]);
    
        $PaymentType->update($request->all());
    
        return redirect()->route('hrm.payment_types.index')
                        ->with('success','PaymentType updated successfully');
    }
    public function destroy(PaymentType $PaymentType)
    {
        $PaymentType->delete();
    
        return redirect()->route('hrm.payment_types.index')
                        ->with('success','PaymentType deleted successfully');
    }
}

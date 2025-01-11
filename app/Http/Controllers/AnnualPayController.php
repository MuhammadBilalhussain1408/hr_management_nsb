<?php

namespace App\Http\Controllers;

use App\Models\AnnualPay;
use App\Models\PayGroup;
use Illuminate\Http\Request;

class AnnualPayController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:AnnualPay-list|AnnualPay-create|AnnualPay-edit|AnnualPay-delete', ['only' => ['index','show']]);
         $this->middleware('permission:AnnualPay-create', ['only' => ['create','store']]);
         $this->middleware('permission:AnnualPay-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:AnnualPay-delete', ['only' => ['destroy']]);
    }
   
    public function index()
    {
        $datas = AnnualPay::latest()->paginate('20');
        return view('hrm.annual_pays.index',compact('datas'));
    }
  
    public function create()
    {
        $paygroups = PayGroup::where('status','Enable')->get();
        return view('hrm.annual_pays.create', compact('paygroups'));
    }
  
    public function store(Request $request)
    {
        request()->validate([
          // 'annual_pay' => 'required',
          //  'pay_group_id' => 'required',
        ]);
    
        AnnualPay::create($request->all());
    
        return redirect()->route('hrm.annual_pays.index')
                        ->with('success','AnnualPay created successfully.');
    }
  
    public function show(AnnualPay $annual_pay)
    {
        return view('hrm.annual_pays.show',compact('AnnualPay'));
    }
   
    public function edit(AnnualPay $annual_pay)
    {
        $paygroups = PayGroup::where('status','Enable')->get();
        return view('hrm.annual_pays.edit',compact('annual_pay','paygroups'));
    }
   
    public function update(Request $request, AnnualPay $annual_pay)
    {
         request()->validate([
            'annual_pay' => 'required',
            'pay_group_id' => 'required',
        ]);
    
        $annual_pay->update($request->all());
    
        return redirect()->route('hrm.annual_pays.index')
                        ->with('success','AnnualPay updated successfully');
    }
    public function destroy(AnnualPay $annual_pay)
    {
        $annual_pay->delete();
    
        return redirect()->route('hrm.annual_pays.index')
                        ->with('success','AnnualPay deleted successfully');
    }
}

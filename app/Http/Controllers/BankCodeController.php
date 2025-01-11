<?php

namespace App\Http\Controllers;

use App\Models\BankCode;
use App\Models\Bank;
use Illuminate\Http\Request;
use Auth;

class BankCodeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:bankcode-list|bankcode-create|bankcode-edit|bankcode-delete', ['only' => ['index','show']]);
         $this->middleware('permission:bankcode-create', ['only' => ['create','store']]);
         $this->middleware('permission:bankcode-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bankcode-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $bankcodes = BankCode::latest()->paginate('20');
        } else {
            $bankcodes = BankCode::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.bankcodes.index',compact('bankcodes'));
    }
    public function create()
    {
        $org = Auth::user()->org->id;
        $banks = Bank::where('organization_id', $org)->where('status','Enable')->get();
        return view('hrm.bankcodes.create',compact('banks'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'code' => 'required',
            'status' => 'required',
        ]);
    
        BankCode::create($request->all());
    
        return redirect()->route('hrm.bankcodes.index')
                        ->with('success','BankCode created successfully.');
    }
    public function show(BankCode $bankcode)
    {
        return view('hrm.bankcodes.show',compact('BankCode'));
    }
    public function edit(BankCode $bankcode)
    {
        $org = Auth::user()->org->id;
        $banks = Bank::where('organization_id', $org)->where('status','Enable')->get();
        return view('hrm.bankcodes.edit',compact('bankcode','banks'));
    }
    public function update(Request $request, BankCode $bankcode)
    {
         request()->validate([
            'code' => 'required',
            'status' => 'required',
        ]);
    
        $bankcode->update($request->all());
    
        return redirect()->route('hrm.bankcodes.index')
                        ->with('success','BankCode updated successfully');
    }
    public function destroy(BankCode $bankcode)
    {
        $bankcode->delete();
    
        return redirect()->route('hrm.bankcodes.index')
                        ->with('success','BankCode deleted successfully');
    }
    public function bank_code(Request $request, $bank_id)
    {
        $sers = BankCode::where('bank_id', $bank_id)->select('bank_id', 'code')->get();
        echo json_encode($sers);
    }
}

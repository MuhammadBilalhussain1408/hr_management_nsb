<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Auth;

class BankController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:bank-list|bank-create|bank-edit|bank-delete', ['only' => ['index','show']]);
         $this->middleware('permission:bank-create', ['only' => ['create','store']]);
         $this->middleware('permission:bank-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bank-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $banks = Bank::latest()->paginate('20');
        } else {
            $banks = Bank::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.banks.index',compact('banks'));
    }
    public function create()
    {
        return view('hrm.banks.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        bank::create($request->all());
    
        return redirect()->route('hrm.banks.index')
                        ->with('success','bank created successfully.');
    }
    public function show(Bank $bank)
    {
        return view('hrm.banks.show',compact('bank'));
    }
    public function edit(Bank $bank)
    {
        return view('hrm.banks.edit',compact('bank'));
    }
    public function update(Request $request, Bank $bank)
    {
         request()->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        $bank->update($request->all());
    
        return redirect()->route('hrm.banks.index')
                        ->with('success','bank updated successfully');
    }
    public function destroy(Bank $bank)
    {
        $bank->delete();
    
        return redirect()->route('hrm.banks.index')
                        ->with('success','bank deleted successfully');
    }

}

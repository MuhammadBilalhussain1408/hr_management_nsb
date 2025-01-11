<?php

namespace App\Http\Controllers;

use App\Models\WedgesPayMode;
use Illuminate\Http\Request;
use Auth;

class WedgesPayModeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:WedgespayMode-list|WedgespayMode-create|WedgespayMode-edit|WedgespayMode-delete', ['only' => ['index','show']]);
         $this->middleware('permission:WedgespayMode-create', ['only' => ['create','store']]);
         $this->middleware('permission:WedgespayMode-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:WedgespayMode-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = WedgesPayMode::latest()->paginate('20');
        } else {
            $datas = WedgesPayMode::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.wedges_pay_modes.index',compact('datas'));
    }
    public function create()
    {
        return view('hrm.wedges_pay_modes.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'payment_type' => 'required',
        ]);
    
        WedgesPayMode::create($request->all());
    
        return redirect()->route('hrm.wedges_pay_modes.index')
                        ->with('success','Wedges Pay Mode created successfully.');
    }
    public function show(WedgesPayMode $data)
    {
        return view('hrm.wedges_pay_modes.show',compact('data'));
    }
    public function edit(WedgesPayMode $WedgesPayMode)
    {
        return view('hrm.wedges_pay_modes.edit',compact('WedgesPayMode'));
    }
    public function update(Request $request, WedgesPayMode $data)
    {
         request()->validate([
            'payment_type' => 'required',
        ]);
    
        $data->update($request->all());
    
        return redirect()->route('hrm.wedges_pay_modes.index')
                        ->with('success','Wedges Pay Mode updated successfully');
    }
    public function destroy(WedgesPayMode $data)
    {
        $data->delete();
    
        return redirect()->route('hrm.wedges_pay_modes.index')
                        ->with('success','Wedges Pay Mode deleted successfully');
    }
}

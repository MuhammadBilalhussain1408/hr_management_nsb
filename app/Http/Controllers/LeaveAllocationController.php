<?php

namespace App\Http\Controllers;

use App\Models\LeaveAllocation;
use App\Models\Organization;
use App\Models\EmployeeType;
use App\Models\LeaveRule;
use App\Models\LeaveType;
use App\Models\Employee;
use Illuminate\Http\Request;
use Auth;
use Str;
use App\Exports\LeaveReportExport;
use Maatwebsite\Excel\Facades\Excel;


class LeaveAllocationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Leave-allocation-list|Leave-allocation-create|Leave-allocation-edit|Leave-allocation-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Leave-allocation-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Leave-allocation-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Leave-allocation-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $etypes = EmployeeType::get();
            $LeaveAllocations = LeaveAllocation::paginate('20');
        } else {
            $etypes = EmployeeType::where('organization_id', $org)->get();
            $LeaveAllocations = LeaveAllocation::where('organization_id', $org)->paginate('20');
        }

        return view('hrm.leave_allocations.index', compact('LeaveAllocations', 'etypes'));
    }
    public function create()
    {
        $org =  Auth::user()->org->id;
        $etypes = EmployeeType::where('organization_id', $org)->get();
        $leave_types = LeaveType::where('organization_id', $org)->get();
        return view('hrm.leave_allocations.create', compact('leave_types', 'etypes'));
    }
    public function leave_allocations_search(Request $request)
    {
        $org =  Auth::user()->org->id;
        $etypes = $request->employee_type_id;
        $retypes = EmployeeType::where('id', $etypes)->first();
        $emp_id = $request->employee_id;
        $effect_year = $request->effect_year;
        $r_day = date('Y', strtotime('+1 day', strtotime($effect_year)));

        if ($etypes && $emp_id && $effect_year) {
            $lrule = LeaveRule::where('employee_type_id', $etypes)->whereYear('effect_from', $effect_year)->get();
            $l_allocations = LeaveAllocation::whereYear('effect_year', $effect_year)->where('employee_id', $emp_id)->get();
            $employees = Employee::where([['id', $emp_id], ['organization_id', $org], ['employee_type_id', $etypes]])->select('id', 'fname', 'mid_name', 'lname', 'code','employee_type_id')->with('emp_type')->get();
        }
        if ($etypes && $emp_id == 'all' && $effect_year) {
            $lrule = LeaveRule::where('employee_type_id', $etypes)->where('effect_from', '<=', $r_day)->where('effect_to', '>=', $effect_year)->get();
            $l_allocations = LeaveAllocation::where([['organization_id', $org], ['employee_type_id', $etypes], ['effect_year', $effect_year]])->first();
            $employees = Employee::where([['organization_id', $org], ['employee_type_id', $etypes]])->select('id', 'fname', 'mid_name', 'lname', 'code','employee_type_id')->with('emp_type')->get();
        }

        return view('hrm.leave_allocations.search', compact('l_allocations', 'employees', 'lrule'));
    }
    public function store(Request $request)
    {
        // dd($request);

        request()->validate([
            'car' => 'required',
            // 'effect_year' => 'required',
            // 'leave_type_id' => 'required',
            // 'organization_id' => 'required',
        ]);
        $datas = $request['car'];
        if ($datas) {
            foreach ($datas as $key => $all) {

                foreach ($all as $key2 => $value) {
                    //  return $key2;
                    if ($key2 == 'employee_id') {
                        $employee_id = $value;
                    }
                    $data = new LeaveAllocation;
                    $data->slug = $request->organization_id . Str::random(8);
                    $data->employee_id = $employee_id;
                    $data->employee_type_id = $request->employee_type_id;
                    $data->effect_year = $request->effect_year;
                    $data->leave_rule_id = $request->leave_rule_id;
                    $data->leave_type_id = $request->leave_type_id;
                    $data->organization_id = $request->organization_id;
                    $data->leave_hand = $request->leave_hand;
                    $data->max_no = $request->max_no;
                    $data->save();
                }
            }
        }

        return redirect()->route('hrm.leave_allocations.index')
            ->with('success', 'LeaveAllocation created successfully.');
    }
    public function show(LeaveAllocation $LeaveAllocation)
    {
        //
    }

    public function edit($id)
    {
        $org =  Auth::user()->org->id;
        $LeaveAllocation = LeaveAllocation::where('slug', $id)->first();
        $r_day = date('Y-m-d', strtotime('+1 day', strtotime($LeaveAllocation->effect_year)));
        $employee = Employee::where([['id', $LeaveAllocation->employee_id]])->select('id', 'fname', 'mid_name', 'lname', 'code')->first();
        $lrule = LeaveRule::where('id', $LeaveAllocation->leave_rule_id)->select('id', 'max_no')->first();
        //  $ltype = LeaveType::where('id', $LeaveAllocation->leave_type_id)->select('id','name')->first();
        //   $ltype = $LeaveAllocation->leave_types;

        return view('hrm.leave_allocations.edit', compact('LeaveAllocation', 'employee', 'lrule'));
    }


    public function update(Request $request, LeaveAllocation $LeaveAllocation)
    {
        request()->validate([
            'leave_hand' => 'required',
        ]);
        //   $request['slug'] = Str::random(8);

        $LeaveAllocation->leave_hand = $LeaveAllocation->max_no - $request->leave_hand;
        $LeaveAllocation->save();
        // $LeaveAllocation->update($request->all());

        return redirect()->route('hrm.leave_allocations.index')
            ->with('success', 'LeaveAllocation updated successfully');
    }
    public function destroy(LeaveAllocation $leaveAllocation)
    {
        $leaveAllocation->delete();

        return redirect()->route('hrm.leave_allocations.index')
            ->with('success', 'leaveAllocation deleted successfully');
    }
    public function leave_balance()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $LeaveAllocations = LeaveAllocation::paginate('20');
        } else {
            $LeaveAllocations = LeaveAllocation::where('organization_id', $org)->paginate('20');
        }

        return view('hrm.leave_balance.index', compact('LeaveAllocations'));
    }
    public function leave_report()
    {
        return view('hrm.leave_report.search');
    }
    public function leave_report_employee(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            if($request->organization_id){
                $employees =  Employee::where('organization_id', $request->organization_id)->select('id','code','fname','mid_name','lname')->get();
               }
            else{
                $employees =  Employee::select('id','code','fname','mid_name','lname')->get();
                }
        } else {
            $employees =  Employee::where('organization_id', $org)->select('id','code','fname','mid_name','lname')->get();
         }
        return view('hrm.leave_report.employee_wise', compact('employees'));
    }
    public function leave_report_excell(Request $request)
    {
        $year = $request->effect_year;
        $employee_id = $request->employee_id;
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = $user->org->id;
        if($year && $employee_id){
            if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
                if($request->organization_id){
                    $employees =  Employee::where('id', $employee_id)->where('organization_id', $request->organization_id)->select('id','code','fname','mid_name','lname','employee_type_id','designation_id','department_id')->first();
                    $l_allocation =  LeaveAllocation::where('employee_id', $employee_id)->whereYear('effect_year', $year)->where('organization_id', $request->organization_id)->get();
                }
                else{
                    $employees =  Employee::where('id', $employee_id)->select('id','code','fname','mid_name','lname','employee_type_id','designation_id','department_id')->first();
                    $l_allocation = LeaveAllocation::where('employee_id', $employee_id)->whereYear('effect_year', $year)->get();
                }
            } else {
                $employees =  Employee::where('id', $employee_id)->where('organization_id', $org)->select('id','code','fname','mid_name','lname','employee_type_id','designation_id','department_id')->first();
                $l_allocation =  LeaveAllocation::where('employee_id', $employee_id)->whereYear('effect_year', $year)->where('organization_id', $org)->get();
            }

            return view('hrm.leave_report.employee_report', compact('org','employees','l_allocation'));
        }
        if($year){
            if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
                if($request->organization_id){
                    $employees =  Employee::where('organization_id', $request->organization_id)->select('id','code','fname','mid_name','lname','employee_type_id','designation_id','department_id')->get();
                    $leave_types = LeaveType::select('id','name')->where('organization_id', $request->organization_id)->get();
                    $l_allocation =  LeaveAllocation::whereYear('effect_year', $year)->where('organization_id', $request->organization_id)->get();
                }
                else{
                    $employees =  Employee::select('id','code','fname','mid_name','lname','employee_type_id','designation_id','department_id')->get();
                    $leave_types = LeaveType::select('id','name')->get();
                    $l_allocation = LeaveAllocation::whereYear('effect_year', $year)->where('organization_id', $org)->get();
                }
            } else {
                $employees =  Employee::where('organization_id', $org)->select('id','code','fname','mid_name','lname','employee_type_id','designation_id','department_id')->get();
                $leave_types = LeaveType::select('id','name')->where('organization_id', $org)->get();
                $l_allocation =  LeaveAllocation::whereYear('effect_year', $year)->where('organization_id', $org)->get();
            }
            return view('hrm.leave_report.report', compact('org','leave_types','employees','year','l_allocation'));
            // $fileName = $year . '_report' . '.xlsx';
            // return Excel::download(new LeaveReportExport(['year' => $year], ['org' => $org]), $fileName);
        
        }
   
    }
    public function leave_request_approver()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $etypes = EmployeeType::get();
            $LeaveAllocations = LeaveAllocation::paginate('20');
        } else {
            $etypes = EmployeeType::where('organization_id', $org)->get();
            $LeaveAllocations = LeaveAllocation::where('organization_id', $org)->paginate('20');
        }

        return view('hrm.leave_allocations.approval', compact('LeaveAllocations', 'etypes'));
    }
    public function approved(Request$request, $id)
    {
        $leaveAllocation = LeaveAllocation::find($id);
        $leaveAllocation->status = 'Approved';
        $leaveAllocation->save();

        return redirect()->route('hrm.leave_request_approver')
            ->with('success', 'leaveAllocation deleted successfully');
    }
}

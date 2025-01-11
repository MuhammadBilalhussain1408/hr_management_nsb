<?php

namespace App\Http\Controllers;

use App\Models\RightWork;
use App\Models\Organization;
use App\Models\Employee;
use App\Models\Checktype;
use App\Models\Checkmidium;
use App\Models\Passport;
use App\Models\Physicallist;
use App\Models\Physicallist1Group;
use App\Models\Physicallist2Group;
use Illuminate\Http\Request;
use Auth;
use App\Exports\RightWorkExport;
use Maatwebsite\Excel\Facades\Excel;

class RightWorkController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:RightWork-list|RightWork-create|RightWork-edit|RightWork-delete|only-organization', ['only' => ['index', 'show']]);
        $this->middleware('permission:RightWork-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:RightWork-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:RightWork-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
         $org = Auth::user()->org->id;
      //  $organization = Organization::where('slug', $user->slug)->value('id');
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $datas = RightWork::with('employees:id,fname,lname,mid_name')->get();
        } else {
            $datas = RightWork::where('organization_id', $org)->with('employees:id,fname,lname,mid_name')->get();
        }

        return view('hrm.rightwork.index', compact('datas'));
    }


    public function create()
    {
        $user = Auth::user()->slug;
        $org = Auth::user()->org->id;
        $organization = Organization::where('id', $org)->select('id', 'company_name', 'con_num', 'authemail', 'f_name', 'l_name', 'designation')->first();
       
        $datas = [
            'employees' => Employee::where('organization_id', $org)->select('id', 'fname', 'lname', 'mid_name')->get(),
            'checktypes' => Checktype::select('id', 'name')->get(),
            'checkmidias' => Checkmidium::select('id', 'name')->get(),
            'plists' => Physicallist::select('id', 'name')->get(),
            'plist1g' => Physicallist1Group::select('id', 'name')->get(),
            'plist2g' => Physicallist2Group::select('id', 'name')->get(),
            'passports' => Passport::select('id', 'name')->get(),
        ];
        return view('hrm.rightwork.create', compact('organization', 'datas'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'employee_id' => 'required',
            'organization_id' => 'required',
        ]);

        $data = RightWork::create($request->all());
        $data->employees()->attach($request->employee_id);
        $data->checktypes()->attach($request->checktype_id);
        $data->checkmidias()->attach($request->checkmidia_id);
        $data->plists()->attach($request->physicallist_id);
        $data->plist1g()->attach($request->physicallist1_group_id);
        $data->plist2g()->attach($request->physicallist2_group_id);
        $data->passports()->attach($request->passport_id);

        return redirect()->route('hrm.right_works.index')
            ->with('success', 'right_work created successfully.');
    }


    public function show(RightWork $rightWork)
    {
        $org = Organization::where('id', $rightWork->organization_id)->select('id', 'company_name', 'con_num', 'authemail', 'f_name', 'l_name', 'designation')->first();
      // return $dd =  $rightWork->plist2g;
         $datas = [
            'employee' => Employee::where('id', $rightWork->employee_id)->select('id', 'fname', 'lname', 'mid_name','passport_proof','pr_add_proof')->first(),
            'checktypes' => Checktype::select('id', 'name')->get(),
            'plist1' => $rightWork->plist1g,
            'plist2' => $rightWork->plist2g,
            'checkmidias' => Checkmidium::select('id', 'name')->get(),
            'plists' => Physicallist::select('id', 'name')->get(),
            'plist1g' => Physicallist1Group::select('id', 'name')->get(),
            'plist2g' => Physicallist2Group::select('id', 'name')->get(),
            'passports' => Passport::select('id', 'name')->get(),
        ];
        return view('hrm.rightwork.show', compact('rightWork', 'org','datas'));
    }


    public function edit(RightWork $rightWork)
    {
        $user = Auth::user()->slug;
     // return  $rightWork->plist1g;
        $organization = Organization::where('id', $rightWork->organization_id)->select('id', 'company_name', 'con_num', 'authemail', 'f_name', 'l_name', 'designation')->first();
        $datas = [
            'employee' => Employee::where('id', $rightWork->employee_id)->select('id', 'fname', 'lname', 'mid_name')->first(),
            'employees' => Employee::where('organization_id', $organization->id)->select('id', 'fname', 'lname', 'mid_name')->get(),
            'checktypes' => Checktype::select('id', 'name')->get(),
            'checkmidias' => Checkmidium::select('id', 'name')->get(),
            'plists' => Physicallist::select('id', 'name')->get(),
            'plist1g' => Physicallist1Group::select('id', 'name')->get(),
            'plist2g' => Physicallist2Group::select('id', 'name')->get(),
            'passports' => Passport::select('id', 'name')->get(),
        ];
        return view('hrm.rightwork.edit', compact('datas', 'rightWork', 'organization'));
    }


    public function update(Request $request, RightWork $rightWork)
    {
       // dd($request);
        request()->validate([
            'employee_id' => 'required',
            'organization_id' => 'required',
        ]);

        $rightWork->update($request->all());

        $rightWork->employees()->detach();
        $rightWork->employees()->attach($request->employee_id);
        $rightWork->checktypes()->detach();
        $rightWork->checktypes()->attach($request->checktype_id);
        $rightWork->checkmidias()->detach();
        $rightWork->checkmidias()->attach($request->checkmidia_id);
        $rightWork->plists()->detach();
        $rightWork->plists()->attach($request->physicallist_id);
        $rightWork->plist1g()->detach();
        $rightWork->plist1g()->attach($request->physicallist1_group_id);
        $rightWork->plist2g()->detach();
        $rightWork->plist2g()->attach($request->physicallist2_group_id);
        $rightWork->passports()->detach();
        $rightWork->passports()->attach($request->passport_id);

        return redirect()->route('hrm.right_works.index')
            ->with('success', 'right_work update successfully.');
    }

    public function rightwork_excel($id)
    {
        $data = RightWork::find($id);
        $org =  Organization::where('id', $data->organization_id)->select('company_name')->first();
        $employee = Employee::where('id', $data->employee_id)->select('id', 'fname', 'lname', 'mid_name')->first();
        $fileName = $employee->fname . '_right_work' . '.xlsx';
        return Excel::download(new RightWorkExport(['data' => $id, 'employee' => $employee, 'org' => $org]), $fileName);
    }
    public function destroy(Request $request, RightWork $rightWork)
    {
        $rightWork->delete();
        // $edu = DB::table('rightwork_has_employee')->where('right_work_id', $request->id)->delete();
        if ($rightWork->employees()) {
            $rightWork->employees()->detach();
        }
        return redirect()->route('hrm.right_works.index')
            ->with('success', 'employee deleted successfully');
    }

}

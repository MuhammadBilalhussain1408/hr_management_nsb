<?php

namespace App\Http\Controllers;

use App\Models\JobApplied;
use Illuminate\Http\Request;
use Auth;

class JobAppliedController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Jobapplied-list|Jobapplied-create|Jobapplied-edit|Jobapplied-delete', ['only' => ['index','show']]);
         $this->middleware('permission:Jobapplied-create', ['only' => ['create','store']]);
         $this->middleware('permission:Jobapplied-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:Jobapplied-delete', ['only' => ['destroy']]);
    }
  
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobapplieds = JobApplied::where('status','Application Received')->latest()->paginate('20');

        } else {
            $jobapplieds = JobApplied::where('status','Application Received')->where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_applieds.index',compact('jobapplieds'));
    }
    public function job_shortlist()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobapplieds = JobApplied::where('status','Short listed')->latest()->paginate('20');

        } else {
            $jobapplieds = JobApplied::where('status','Short listed')->where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_applieds.job_shortlist',compact('jobapplieds'));
    }
    public function interview()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobapplieds = JobApplied::where('status','Interview')->latest()->paginate('20');

        } else {
            $jobapplieds = JobApplied::where('status','Interview')->where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_applieds.interview',compact('jobapplieds'));
    }
    public function hired()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobapplieds = JobApplied::where('status','Hired')->latest()->paginate('20');

        } else {
            $jobapplieds = JobApplied::where('status','Hired')->where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_applieds.hired',compact('jobapplieds'));
    }
    public function offer_letter()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobapplieds = JobApplied::where('status','Job Offered')->latest()->paginate('20');

        } else {
            $jobapplieds = JobApplied::where('status','Job Offered')->where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_applieds.offer_letter',compact('jobapplieds'));
    }
    public function rejectted()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobapplieds = JobApplied::where('status','Rejected')->latest()->paginate('20');

        } else {
            $jobapplieds = JobApplied::where('status','Rejected')->where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.job_applieds.rejectted',compact('jobapplieds'));
    }
    public function create()
    {
        return view('hrm.job_applieds.create');
    }
    public function store(Request $request)
    {
        request()->validate([
            'code' => 'required',
            'status' => 'required',
        ]);
    
        JobApplied::create($request->all());
    
        return redirect()->route('hrm.job_applieds.index')
                        ->with('success','Jobapplied created successfully.');
    }
    public function show(JobApplied $Jobapplied)
    {
        return view('hrm.job_applieds.show',compact('Jobapplied'));
    }
    public function edit(jobApplied $jobApplied)
    {
        return view('hrm.job_applieds.edit',compact('jobApplied'));
    }
    public function update(Request $request, JobApplied $JobApplied)
    {
         request()->validate([
            'job_post_id' => 'required',
            'status' => 'required',
        ]);
    
        $JobApplied->update($request->all());
    
        return redirect()->route('hrm.job_applieds.index')
                        ->with('success','Jobapplied updated successfully');
    }
    public function destroy(JobApplied $JobApplied)
    {
        $JobApplied->delete();
    
        return redirect()->route('hrm.job_applieds.index')
                        ->with('success','Jobapplied deleted successfully');
    }
}

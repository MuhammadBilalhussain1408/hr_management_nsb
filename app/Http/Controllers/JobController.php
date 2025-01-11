<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Department;
use Illuminate\Http\Request;
use Auth;

class JobController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:job-list|job-create|job-edit|job-delete', ['only' => ['index','show']]);
         $this->middleware('permission:job-create', ['only' => ['create','store']]);
         $this->middleware('permission:job-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:job-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobs = Job::latest()->paginate('20');
        } else {
            $jobs = Job::where('organization_id', $org)->latest()->paginate('20');
        }
        return view('hrm.jobs.index',compact('jobs'));
    }
    
    public function create()
    {
        $user = Auth::user();
        $userRole = $user->roles->pluck('name')->first();
        $org = Auth::user()->org->id;
        if (($userRole == 'Supper Admin') || ($userRole == 'Admin')) {
            $jobs = Job::get();
            $depertments = Department::get();
        } else {
            $jobs = Job::where('organization_id', $org)->get();
            $depertments = Department::where('organization_id', $org)->get();
        }
        return view('hrm.jobs.create',compact('jobs'));
    }
    
    public function store(Request $request)
    {
        if($request->type == 'exiting'){
            $soc_code = $request->socold;
        }
        else{
        $soc_code = $request->socnew;
        }
       
        request()->validate([
            'job_title' => 'required',
            // $soc_code => 'required',
            'status' => 'required',
        ]);
       
        $data = new Job;
        $data->organization_id = $request->organization_id;
        $data->soc_code = $soc_code;
        $data->job_title = $request->job_title;
        $data->job_des = $request->job_des;
        $data->department = $request->department;
        $data->status = $request->status;
        $data->save();
    
      //  Job::create($request->all());
    
        return redirect()->route('hrm.jobs.index')
                        ->with('success','Job created successfully.');
    }
    
    public function show(Job $job)
    {
        $soc_get = Job::where('soc_code',$job->soc_code)->get();
        return view('hrm.jobs.show',compact('soc_get'));
    }
    
    public function edit(Job $job)
    {
        return view('hrm.jobs.edit',compact('job'));
    }
    
    public function update(Request $request, Job $job)
    {
         request()->validate([
            'job_title' => 'required',
            'soc_code' => 'required',
            'status' => 'required',
        ]);
    
        $job->update($request->all());
    
        return redirect()->route('hrm.jobs.index')
                        ->with('success','Job updated successfully');
    }
    
    public function destroy(Job $job)
    {
        $job->delete();
    
        return redirect()->route('hrm.jobs.index')
                        ->with('success','Job deleted successfully');
    }
}